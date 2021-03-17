# Speedy.bg Bundle
Speedy integration for Symfony.  
Documentation of the API can be found here: https://api.speedy.bg/web-api.html

## Installation

* install with Composer
```
composer require answear/speedy-pickup-point-bundle
```

`Answear\SpeedyBundle\AnswearSpeedyBundle::class => ['all' => true],`  
should be added automatically to your `config/bundles.php` file by Symfony Flex.

## Setup

* provide required config data: `privateKey`

```yaml
# config/packages/answear.yaml
answear_speedy:
    username: 'your_username'
    password: 'your_password'
    language: 'BG' 
    clientSystemId: 12345
```

config will be passed to `\Answear\SpeedyBundle\ConfigProvider.php` class.

## Usage

### Find Office

```php
use Answear\SpeedyBundle\Command\FindOffice;
use Answear\SpeedyBundle\Request\FindOfficeRequest;

/** @var FindOffice $findOfficeCommand */
$findOfficeResponse = $findOfficeCommand->findOffice(new FindOfficeRequest());
```


Final notes
------------

Feel free to open pull requests with new features, improvements or bug fixes. The Answear team will be grateful for any comments.

