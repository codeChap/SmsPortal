Qiick and dirty way to send an SMS

## Installation

Install via Composer:

```bash
composer require codechap/sms-portal:"dev-master"
```

## Usage

```php
use Codechap\SmsPortal\Sms;

$sms = new Sms();
$sms->set('clientId', 'your_client_id');
$sms->set('clientSecret', 'your_client_secret');
$sms->send('1234567890', 'Hello, World!');

```
