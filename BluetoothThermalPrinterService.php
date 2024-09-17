<?php

class BluetoothThermalPrinterService
{
    const ROOT_PRINT_LINK = 'my.bluetoothprint.scheme://';
    private $json;
    
    public function __construct(){
        $this->json = [];
    }
    
    public static function new(){
        return new BluetoothThermalPrinterService;
    }
    
    /**
     * Return a json with class contents
     * @return string $json encoded json string
     */ 
    public function createJson(): string {
        $json = json_encode($this->json, JSON_FORCE_OBJECT);
        return $json;
    }
    
    /**
     * sending text entry
     * @param string $content any string	
     * @param int $bold 0 if no, 1 if yes
     * @param int $align 0 if left, 1 if center, 2 if right
     * @param int $format 0 if normal, 1 if double Height, 2 if double Height + Width, 3 if double Width, 4 if small
    */ 
    public function text(string $content, int $bold = 0, int $align = 0 , int $format = 0): ?BluetoothThermalPrinterService 
    {
      $text = new stdClass();
      $text->type = 0;
      $text->content = $content;
      $text->bold = $bold;
      $text->align = $align;
      $text->format = $format;
      
      array_push($this->json, $text);
      
      return $this;
    }
    
    /**
     * sending image entry
     * @param string $path complete filepath on your web server; make sure that it is not big size
     * @param int $align 0 if left, 1 if center, 2 if right
     */ 
    public function image(string $path, int $align = 0): ?BluetoothThermalPrinterService 
    {
        $image = new stdClass();
        $image->type = 1;
        $image->path = $path;
        $image->align = $align;
        
        array_push($this->json, $image);
        
        return $this;
    }
    
    /**
     * sending barcode entry	
     * @param string $value valid barcode value
     * @param int $width valid barcode width
     * @param int $height valid barcode height
     * @param int $align 0 if left, 1 if center, 2 if right
     */
    public function barcode(string $value, int $width, int $height, int $align = 0): ?BluetoothThermalPrinterService 
    {
        $barcode = new stdClass;
        $barcode->type = 2;
        $barcode->value = $value;
        $barcode->width = $width;
        $barcode->height = $height;
        $barcode->align = $align;
        
        array_push($this->json, $barcode);
        
        return $this;
    }
    
    /**
     * sending QR entry
     * @param string $value valid QR code value
     * @param int $size valid QR code size in mm
     * @param int $align 0 if left, 1 if center, 2 if right
     */ 
    public function qrcode(sting $value, int $size, int $align = 0): ?BluetoothThermalPrinterService 
    {
        $qrcode = new stdClass;
        $qrcode->type = 3;
        $qrcode->value = $value;
        $qrcode->size = $size;
        $qrcode->align = $align;
        
        array_push($this->json, $qrcode);
        
        return $this;
    }
    
    /**
     * sending HTML Code	
     * @param string $content HTML code
     */ 
    public function html(string $content): ?BluetoothThermalPrinterService 
    {
        $html = new stdClass;
        $html->type = 4;
        $html->content = $content;
        
        array_push($this->json, $html);
        
        return $this;
    }
    
    /**
     * sending empty line
     */ 
    public function emptyLine(): ?BluetoothThermalPrinterService 
    {
        return $this->text(' ');
    }
}
