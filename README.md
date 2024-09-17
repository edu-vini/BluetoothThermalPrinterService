# BluetoothThermalPrinterService

`BluetoothThermalPrinterService` é uma classe PHP que facilita a geração de comandos em formato JSON para impressão em impressoras térmicas Bluetooth. Através desta classe, é possível enviar texto, imagens, códigos de barras, QR codes, HTML e linhas vazias para a impressora.

## Requisitos

- PHP 7.0 ou superior
- Servidor Web compatível com PHP

## Instalação

Você pode instalar a classe manualmente. Basta adicionar o arquivo `BluetoothThermalPrinterService.php` ao seu projeto e incluí-lo em seu código:

```php
require_once 'BluetoothThermalPrinterService.php';
```

## Uso

### Inicialização

Para iniciar o uso da classe, crie uma nova instância:

```php
$printerService = BluetoothThermalPrinterService::new();
```

### Funções Disponíveis

#### 1. `text($content, $bold = 0, $align = 0, $format = 0)`

Adiciona uma entrada de texto à impressão.

- **Parâmetros:**
  - `$content` (string): O conteúdo do texto a ser impresso.
  - `$bold` (int): Define se o texto será negrito (0 = não, 1 = sim).
  - `$align` (int): Alinhamento do texto (0 = esquerda, 1 = centro, 2 = direita).
  - `$format` (int): Formato do texto (0 = normal, 1 = altura dupla, 2 = altura + largura dupla, 3 = largura dupla, 4 = pequeno).

#### 2. `image($path, $align = 0)`

Adiciona uma entrada de imagem à impressão.

- **Parâmetros:**
  - `$path` (string): Caminho completo da imagem no servidor.
  - `$align` (int): Alinhamento da imagem (0 = esquerda, 1 = centro, 2 = direita).

#### 3. `barcode($value, $width, $height, $align = 0)`

Adiciona uma entrada de código de barras à impressão.

- **Parâmetros:**
  - `$value` (string): Valor do código de barras.
  - `$width` (int): Largura do código de barras.
  - `$height` (int): Altura do código de barras.
  - `$align` (int): Alinhamento do código de barras (0 = esquerda, 1 = centro, 2 = direita).

#### 4. `qrcode($value, $size, $align = 0)`

Adiciona uma entrada de QR code à impressão.

- **Parâmetros:**
  - `$value` (string): Valor do QR code.
  - `$size` (int): Tamanho do QR code em milímetros.
  - `$align` (int): Alinhamento do QR code (0 = esquerda, 1 = centro, 2 = direita).

#### 5. `html($content)`

Adiciona uma entrada de HTML à impressão.

- **Parâmetros:**
  - `$content` (string): O conteúdo HTML a ser impresso.

#### 6. `emptyLine()`

Adiciona uma linha vazia à impressão.

#### 7. `createJson()`

Gera e retorna a saída JSON final.

### Exemplo Completo

```php
$printerService = BluetoothThermalPrinterService::new()
    ->text('Olá Mundo', 1, 1, 0)
    ->image('/caminho/para/imagem.png', 1)
    ->barcode('123456789012', 100, 200, 0)
    ->qrcode('https://www.example.com', 50, 1)
    ->emptyLine()
    ->createJson();

echo $printerService;
```

### Saída

O método `createJson()` retorna o JSON gerado com todas as entradas adicionadas:

```json
{
    "0": {
        "type": 0,
        "content": "Olá Mundo",
        "bold": 1,
        "align": 1,
        "format": 0
    },
    "1": {
        "type": 1,
        "path": "/caminho/para/imagem.png",
        "align": 1
    },
    "2": {
        "type": 2,
        "value": "123456789012",
        "width": 100,
        "height": 200,
        "align": 0
    },
    "3": {
        "type": 3,
        "value": "https://www.example.com",
        "size": 50,
        "align": 1
    },
    "4": {
        "type": 0,
        "content": " "
    }
}
```

## Licença

Este projeto está sob a [MIT License](LICENSE).
