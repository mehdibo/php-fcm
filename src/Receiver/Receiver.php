<?php

namespace Mehdibo\Fcm\Receiver;


interface Receiver
{

    public function getTargetName():string;
    public function getTargetValue():string;

}