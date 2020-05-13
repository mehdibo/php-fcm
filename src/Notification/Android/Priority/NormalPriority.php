<?php


namespace Mehdibo\Fcm\Notification\Android\Priority;


/**
 * Class NormalPriority
 * @package Mehdibo\Fcm\Notification\Android\Priority
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidmessagepriority
 */
class NormalPriority implements Priority
{

    public function getValue(): string
    {
        return 'NORMAL';
    }
}