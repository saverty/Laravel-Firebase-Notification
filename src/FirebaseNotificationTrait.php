<?php

namespace Saverty\FirebaseNotification;

use Saverty\FirebaseNotification\FirebaseNotification;

trait FirebaseNotificationTrait{
    public function addFcmToken($token){
        $this->fcm_token = $token;
        $this->save();

        return $this;
    }

    public function sendFirebaseNotification($title, $body, $data = null, $action = null){
        FirebaseNotification::sendToUser($this, $title, $body, $data, $action);
    }
}
