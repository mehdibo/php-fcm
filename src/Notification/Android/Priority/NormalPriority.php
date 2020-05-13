<?php


namespace Mehdibo\Fcm\Notification\Android\Priority;


class NormalPriority implements Priority
{

    public function getValue(): string
    {
        return 'NORMAL';
    }
}