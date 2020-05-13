<?php

namespace Mehdibo\Fcm\Receiver;


/**
 * Registration token to send a message to.
 * @package Mehdibo\Fcm\Receiver
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#resource:-message
 */
class Device implements Receiver
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getTargetName(): string
    {
        return 'token';
    }

    public function getTargetValue(): string
    {
        return $this->token;
    }
}