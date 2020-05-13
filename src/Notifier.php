<?php

namespace Mehdibo\Fcm;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Mehdibo\Fcm\Exception\InvalidReceiver;
use Mehdibo\Fcm\Exception\ReceiverNotFound;
use Mehdibo\Fcm\Notification\Notification;
use Mehdibo\Fcm\Receiver\Receiver;

class Notifier
{
    private const API_ENDPOINT = 'https://fcm.googleapis.com/v1';

    private string $projectId;

    private ClientInterface $client;

    public function __construct(string $projectId, ClientInterface $authenticatedClient)
    {
        $this->projectId = $projectId;
        $this->client = $authenticatedClient;
    }

    private function getUrl():string
    {
        return self::API_ENDPOINT.'/projects/'.$this->projectId.'/messages:send';
    }

    /**
     * @param mixed[] $data
     * @throws GuzzleException
     * @throws ReceiverNotFound|InvalidReceiver
     */
    private function sendRequest(array $data):void
    {
        $response = $this->client->request('POST', $this->getUrl(),
            [
                'json' => $data,
            ]
        );
        if ($response->getStatusCode() === 200)
            return;
        $body = \json_decode($response->getBody()->getContents());
        $error = $body->error;
        if ($error->status === 'NOT_FOUND')
            throw new ReceiverNotFound('The receiver you specified is not found, more details: '.
                                       "message: '".$error->message."' errorCode:'".$error->details[0]->errorCode."'"
            );
        if ($error->status === 'INVALID_ARGUMENT')
            throw new InvalidReceiver($error->message);
    }

    /**
     * @param Notification $notification
     * @param Receiver $receiver
     * @throws GuzzleException
     */
    public function send(Notification $notification, Receiver $receiver):void
    {
        $message = [
            $receiver->getTargetName() => $receiver->getTargetValue(),
            $notification->getNotificationName() => $notification->getNotificationBody(),
        ];
        if ($notification->getData() !== NULL)
            $message['data'] = $notification->getData();
        $this->sendRequest(['message' => $message]);
    }

}