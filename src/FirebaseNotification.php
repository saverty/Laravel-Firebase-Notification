<?php

namespace Saverty\FirebaseNotification;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\User;

class FirebaseNotification
{

    public static function sendTo($users, $title, $body, $data = null, $action = null){
        $tokens = [];
        $data = ($data === null) ? [] : $data;

        foreach($users as $user){
            if($user->fcm_token !== null){
                $tokens[] = $user->fcm_token;
            }
        }

        self::send($tokens, $title, $body, $data, $action);

    }

    public static function sendToUser($user, $title, $body, $data = null, $action = null){
        $data = ($data === null) ? [] : $data;

        if($user->fcm_token !== null){
            $tokens[] = $user->fcm_token;
        }

        self::send($tokens, $title, $body, $data, $action);
    }

    public static function send($tokens, $title, $body, $data, $action){


        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default');

        if($action !== null){
            $notificationBuilder->setClickAction($action);
        }

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        FCM::sendTo($tokens, $option, $notification, $data);
    }
}
