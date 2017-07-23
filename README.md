# Tencent Xinge Notification Channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/freyo/xinge.svg?style=flat-square)](https://packagist.org/packages/freyo/xinge)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/freyo/xinge.svg?style=flat-square)](https://packagist.org/packages/freyo/xinge)

This package makes it easy to send notifications using Tencent Xinge with Laravel.

## Installation

You can install this package via composer:

``` bash
composer require freyo/xinge:dev-master
```

Next add the service provider to your `config/app.php`:

```php
...
'providers' => [
	...
	 Freyo\Xinge\ServiceProvider::class,
],
...
```

### Setting up the Xinge service

You will need to [create](http://xg.qq.com/) a Xinge app in order to use this channel. Within in this app you will find the `access id and access secret`. Place them inside your `.env` file. In order to load them, add this to your `config/services.php` file:

```php
...
'xinge' => [
    'android' => [
        'access_id'    => env('XINGE_ANDROID_ACCESS_ID'),
        'secret_key'   => env('XINGE_ANDROID_ACCESS_KEY')
    ],
    'ios' => [
        'access_id'    => env('XINGE_IOS_ACCESS_ID'),
        'secret_key'   => env('XINGE_IOS_ACCESS_KEY')
    ],
]
...
```

This will load the Twitter app data from the `.env` file. Make sure to use the same keys you have used there like `XINGE_IOS_ACCESS_ID`.

## Usage

Follow Laravel's documentation to add the channel to your Notification class.

Example: [AndroidPushSingleAccount](https://github.com/freyo/xinge/blob/master/src/Notifications/AndroidPushSingleAccount.php), [iOSPushSingleAccount](https://github.com/freyo/xinge/blob/master/src/Notifications/iOSPushSingleAccount.php).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
