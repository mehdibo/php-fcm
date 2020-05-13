# php-fcm ![PHP Tests](https://github.com/mehdibo/php-fcm/workflows/PHP%20Tests/badge.svg?branch=develop) [![Latest Stable Version](https://poser.pugx.org/mehdibo/php-fcm/v/stable?format=flat-square)](https://packagist.org/packages/mehdibo/php-fcm) [![Total Downloads](https://poser.pugx.org/mehdibo/php-fcm/downloads?format=flat-square)](https://packagist.org/packages/mehdibo/php-fcm) [![GitHub license](https://img.shields.io/github/license/mehdibo/php-fcm?style=flat-square)](https://github.com/mehdibo/php-fcm/blob/develop/LICENSE) [![GitHub issues](https://img.shields.io/github/issues/mehdibo/php-fcm?style=flat-square)](https://github.com/mehdibo/php-fcm/issues) [![GitHub forks](https://img.shields.io/github/forks/mehdibo/php-fcm?style=flat-square)](https://github.com/mehdibo/php-fcm/network) [![GitHub stars](https://img.shields.io/github/stars/mehdibo/php-fcm)](https://github.com/mehdibo/php-fcm/stargazers)
A PHP library to send Push notifications using FCM (Firebase Cloud Messaging)

Do not use the `Android\*` notifications feature as it is still experimental and may change anytime.

## Setup

### Getting the service account key

Before using the library, you need to get a JSON file containing the neccessary credentials.

- Go to the [Firebase console](https://console.firebase.google.com/u/0/)
- Add a project if you don't have one
- Go to your project dashboard
- On the top left, under the Firebase logo, Click on the cog icon and select *Project settings*
- Go to the *Service accounts* tab. Click on *Create service account* if you don't already have one.
- Click on *Generate new private key*, a prompt will appear, click on *Generate key*.
- A JSON file will start downloading

### Getting the Project ID

After [Getting the service account key](#getting-the-service-account-key), getting the Project ID is farily easy

- Go to your project dashboard
- On the top left, under the Firebase logo, Click on the cog icon and select *Project settings*
- You are in the *General tab*
- The *Project ID* is right under the *Project name*

## Usage

Add the library to your project using
```sh
composer require mehdibo/php-fcm
```

That's it you can start using it like this:

```php
<?php
use Mehdibo\Fcm\Notification\BasicNotification;
use Mehdibo\Fcm\FcmNotifierFactory;
use Mehdibo\Fcm\Receiver\Device;

require "vendor/autoload.php";
$serviceAccountCredentials = 'The path to the service account JSON file';
$projectId = 'The project ID you got from the dashboard';

$notifier = FcmNotifierFactory::create($serviceAccountCredentials, $projectId);

$notification = new BasicNotification('This is the title', 'Body goes here');
$receiver = new Device('the token you receive from the user');

$notifier->send($notification, $receiver);
```

## Using it with symfony
To use this library with Symfony, I recommend the following approach:

Add the library to your project using
```sh
composer require mehdibo/php-fcm
```

If you are using Symfony flex you will be prompted to execute a recipe.
*Choose No*

Add the following vars to your `.env` file:
```dotenv
FCM_SERVICE_ACCOUNT= # The path to your service account json
FCM_PROJECT_ID= # The project ID
FCM_SERVER_KEY= # Used for the DeviceInfoFetcher
```

Add services to your `services.yaml` file:
```yaml
Mehdibo\Fcm\FcmNotifier:
        factory: ['Mehdibo\Fcm\NotifierFactory', 'create']
        arguments:
            $serviceAccountCredentials: '%env(resolve:FCM_SERVICE_ACCOUNT)%'
            $projectId: '%env(FCM_PROJECT_ID)%'

GuzzleHttp\ClientInterface:
        class: GuzzleHttp\Client

Mehdibo\Fcm\Device\DeviceInfoFetcher:
    arguments:
        $serverKey: '%env(FCM_SERVER_KEY)%'
```

## Getting device info

Fetching the device info uses the Legacy API, that uses a *Server Key*

Get the server key by:

- Go to your project dashboard
- On the top left, under the Firebase logo, Click on the cog icon and select *Project settings*
- Go to the *Cloud Messaging* tab
- You will find the *Server Key* there

```php
<?php
use GuzzleHttp\Client;
use Mehdibo\Fcm\Device\DeviceInfoFetcher;

$client = new Client();
$deviceInfoFetcher = new DeviceInfoFetcher('serverKey', $client);

$deviceInfo = $deviceInfoFetcher->fetchInfo('registrationToken');
```
