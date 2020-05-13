<?php


namespace Mehdibo\Fcm\Receiver;


class Topic implements Receiver
{

    private string $topic;


    /**
     * Topic constructor.
     * @param string $topic Without the /topic/prefix
     */
    private function __construct(string $topic)
    {
        $this->topic = $topic;
    }

    public function getTargetName(): string
    {
        return 'topic';
    }

    public function getTargetValue(): string
    {
        return $this->topic;
    }
}