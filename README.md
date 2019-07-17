
  

# Laravel Firebase Notification


Send notification using Firebase and Laravel

### Download the package using composer

    composer require ... 

### Add the package in app.php 
	"providers" => [
		"Saverty/FirebaseNotification::class"
	]

### Publish the package

    php artisan vendor publish

### Edit config/firebase-notification.php

    //Add entities you want to notify
    return [
		'tables' => ['users', '...']
	];

### Run the migrations 

    php artisan migrate

### Add the Trait in the  model

    use Saverty\FirebaseNotification\FirebaseNotificationTrait;
	
	class User extends Authenticatable{
		use FirebaseNotificationTrait;
		
	{

use Notifiable;

use FirebaseNotificationTrait;

### Features 
#### Set the FCM Token
    $user = Auth::user();
    $user->setFcmToken('token');

#### Send notification to a specific user 

    $user = Auth::user();
	$user->sendFirebaseNotification('title', 'This is the body', ['data' => 'this is an example'], 'https://google.fr);

#### Send notification to many users 

    $users = User::all();
    FirebaseNotification::sendTo($users,'title', 'This is the body', [], null)



 
