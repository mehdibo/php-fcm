<?php


namespace Mehdibo\Fcm\Notification;


interface Notification
{

    /**
     * The name of the field sent to the API (ex: android)
     * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#resource:-message
     */
    public function getNotificationName():string;

    /**
     * The data sent with the notification (ex: Basic notification has title, body and image)
     * @return mixed[]
     */
    public function getNotificationBody():array;

    /**
     * An optional payload to send with the notification
     * @return mixed[]
     */
    public function getData():?array;
}