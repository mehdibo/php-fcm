<?php

namespace Mehdibo\Fcm\Receiver;


/**
 * Condition to send a message
 * @package Mehdibo\Fcm\Receiver
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#resource:-message
 */
class Condition implements Receiver
{
    private string $condition;

    public function __construct(string $condition)
    {
        $this->condition = $condition;
    }

    public function getTargetName(): string
    {
        return 'condition';
    }

    public function getTargetValue(): string
    {
        return $this->condition;
    }
}