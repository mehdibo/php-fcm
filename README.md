# php-fcm
A PHP library to send Push notifications using FCM (Firebase Cloud Messaging)

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
use Mehdibo\Fcm\Notification\BasicNotification;
use Mehdibo\Fcm\NotifierFactory;
use Mehdibo\Fcm\Receiver\Device;

require "vendor/autoload.php";
$serviceAccountCredentials = 'The path to the service account JSON file';
$projectId = 'The project ID you got from the dashboard';

$notifier = NotifierFactory::create($serviceAccountCredentials, $projectId);

$notification = new BasicNotification('This is the title', 'Body goes here');
$receiver = new Device('the token you receive from the user');

$notifier->send($notification, $receiver);
```