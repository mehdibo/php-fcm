<?php

namespace Mehdibo\Fcm\Receiver;


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