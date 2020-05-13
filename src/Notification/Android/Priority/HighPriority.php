<?php


namespace Mehdibo\Fcm\Notification\Android\Priority;


/**
 * Class HighPriority
 * @package Mehdibo\Fcm\Notification\Android\Priority
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidmessagepriority
 */
class HighPriority implements Priority
{

    public function getValue(): string
    {
        return 'HIGH';
    }
}