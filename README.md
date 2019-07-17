
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

### Run the migrations 

    php artisan migrate

### Features 
#### Set the user FCM token 

    $user = Auth::user();
    $user->setFcmToken('token');

#### Send notification to a specific user 

    $user = Auth::user();
	$user->sendFirebaseNotification('title', 'This is the body', ['data' => 'this is an example'], 'https://google.fr);

#### Send notification to many users 

    $users = User::all();
    FirebaseNotification::sendTo($users,'title', 'This is the body', [], null)

 

