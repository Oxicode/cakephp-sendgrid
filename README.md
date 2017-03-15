# Sendgrid plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require oxicode/cakephp-Sendgrid
```

## Configuration

In your app.php
```php
    'EmailTransport' => [
        'default' => [
            #Your settings default
        ],
        'Sendgrid' => [
            'className' => 'Sendgrid\Mailer\Transport\SendgridTransport',
            'host' => 'api.sendgrid.com',
            'api_key' => '--- YOUR API HERE ---'
        ]
    ],
    'Email' => [
        'default' => [
            #Your settings default
        ],
        'Sendgrid' => [
            'transport' => 'Sendgrid',
            'from' => 'you2@localhost',
        ]
    ],
```
