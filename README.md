# Clickatell notifications channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/io-digital/clickatell.svg?style=flat-square)](https://packagist.org/packages/io-digital/clickatell)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/io-digital/clickatell.svg?style=flat-square)](https://packagist.org/packages/io-digital/clickatell)


This package makes it easy to send notifications using [clickatell.com](https://www.clickatell.com/) with Laravel 5.5+, 6.x & 7.x.

## Contents

- [Installation](#installation)
    - [Setting up the Clickatell service](#setting-up-the-clickatell-service)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

```bash
composer require io-digital/clickatell
```

### Setting up the clickatell service

Add your Clickatell user, password and api identifier  to your `config/services.php`:

```php
// config/services.php
...
'clickatell' => [
    'api_key' => env('CLICKATELL_API_KEY'),
],
...
```

## Usage

**Number format: +27840000000**

To route Clickatell notifications to the proper phone number, define a ```routeNotificationForClickatell```  method on your notifiable entity:
```php
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForClickatell($notification)
    {
        return $this->phone_number; 
    }
}
```

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use IoDigital\Clickatell\ClickatellMessage;
use IoDigital\Clickatell\ClickatellChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [ClickatellChannel::class];
    }

    public function toClickatell($notifiable)
    {
        return (new ClickatellMessage())
            ->content("Your {$notifiable->service} account was approved!");
    }
}
```

```php
Notification::route('clickatell', 'YOUR E164 NUMBER')
        ->notifyNow(new \App\Notifications\MyNotification($model));
```



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email contact@io.co.za instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [etiennemarais](https://github.com/etiennemarais)
- [arcturial](https://github.com/arcturial)
    - For the [Clickatell Client implementation](https://github.com/arcturial/clickatell) which I leverage on for this wrapper

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
