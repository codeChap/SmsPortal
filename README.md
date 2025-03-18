Qiick and dirty way to send an SMS

## Installation

Install via Composer:

```bash
composer require codechap/sms-portal:"dev-master"
```

You might want to install the `giggsey/libphonenumber-for-php` package for phone number formatting and validation:

```bash
composer require giggsey/libphonenumber-for-php:"^8.13"
```

## Usage

```php
use Codechap\SmsPortal\Sms;

$sms = new Sms();
$sms->set('clientId', 'your_client_id');
$sms->set('clientSecret', 'your_client_secret');
$sms->send('1234567890', 'Hello, World!');

```
