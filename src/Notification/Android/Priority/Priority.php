<?php


namespace Mehdibo\Fcm\Notification\Android\Priority;


/**
 * Interface Priority
 * @package Mehdibo\Fcm\Notification\Android\Priority
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidmessagepriority
 */
interface Priority
{
    public function getValue():string;
}