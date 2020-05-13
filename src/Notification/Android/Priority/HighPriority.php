<?php


namespace Mehdibo\Fcm\Notification\Android\Priority;


class HighPriority implements Priority
{

    public function getValue(): string
    {
        return 'HIGH';
    }
}