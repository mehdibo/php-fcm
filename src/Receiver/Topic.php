<?php


namespace Mehdibo\Fcm\Receiver;


/**
 * Topic name to send a message to
 * @package Mehdibo\Fcm\Receiver
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#resource:-message
 */
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