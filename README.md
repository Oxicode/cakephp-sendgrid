# Sendgrid plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require oxicode/cakephp-Sendgrid
```

## Configuration

In your app.php
```
    'EmailTransport' => [
        'default' => [
            ...
        ],
        'Sendgrid' => [
            'className' => 'Sendgrid\Mailer\Transport\SendgridTransport',
            'host' => 'api.sendgrid.com',
            'api_key' => '--- YOUR API HERE ---'
        ]
    ],

    /**
     * Email delivery profiles
     *
     * Delivery profiles allow you to predefine various properties about email
     * messages from your application and give the settings a name. This saves
     * duplication across your application and makes maintenance and development
     * easier. Each profile accepts a number of keys. See `Cake\Mailer\Email`
     * for more information.
     */
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
        'Sendgrid' => [
            'transport' => 'Sendgrid',
            'from' => 'you2@localhost',
        ]
    ],
```
