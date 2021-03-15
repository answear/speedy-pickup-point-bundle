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

config will be passed to `\Answear\SpeedyBundle\Configuration.php` class.

## Usage

todo

Final notes
------------

Feel free to open pull requests with new features, improvements or bug fixes. The Answear team will be grateful for any comments.

