<?php

namespace Saverty\FirebaseNotification;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Message\Topics;

class FirebaseNotification
{


    /**
     * Send notification to many users
     *
     * @param Collection $users
     * @param string $title Title of the message
     * @param string $body Body of the message
     * @param array $data Data of the mesage
     * @param string $action Call to actio nwhen user click on the notification
     * @return void
     */
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

    /**
     * Send notification to a specific user
     *
     * @param Collection $users
     * @param string $title Title of the message
     * @param string $body Body of the message
     * @param array $data Data of the mesage
     * @param string $action Call to actio nwhen user click on the notification
     * @return void
     */
    public static function sendToUser($user, $title, $body, $data = null, $action = null){
        $data = ($data === null) ? [] : $data;

        if($user->fcm_token !== null){
            $tokens[] = $user->fcm_token;
        }

        self::send($tokens, $title, $body, $data, $action);
    }

    /**
     * Function that send the message
     * This function is used in the sendTo function and in FirebaseNotificationTrait
     *
     * @param array $tokens List of FCM tokens
     * @param string $title Title of the message
     * @param string $body Body of the message
     * @param array $data Data sent in the notification
     * @param string $action Call to action
     * @return void
     */
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

    public static function sendToTopic($topic, $title, $body, $data = null, $action = null){
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic($topic);

        FCM::sendToTopic($topic, null, $notification, $data);
    }
}
