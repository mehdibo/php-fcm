<?php

namespace Mehdibo\Fcm\Receiver;


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