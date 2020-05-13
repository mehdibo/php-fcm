<?php


namespace Mehdibo\Fcm\Device;


use GuzzleHttp\ClientInterface;

class DeviceInfoFetcher
{
    private const API_ENDPOINT = 'https://iid.googleapis.com/iid/info';

    private string $serverKey;

    private ClientInterface $client;

    public function __construct(string $serverKey, ClientInterface $client)
    {
        $this->serverKey = $serverKey;
        $this->client = $client;
    }

    public function fetchInfo(string $registrationToken, bool $details = FALSE):?DeviceInfo
    {
        $response = $this->client->request(
            'GET',
            self::API_ENDPOINT . '/' . $registrationToken,
            [
                'http_errors' => FALSE,
                'headers' => [
                    'Authorization' => 'key=' . $this->serverKey,
                ],
                'query' => [
                    'details' => $details,
                ],
            ]
        );
        if ($response->getStatusCode() !== 200)
            return NULL;
        $data = \json_decode($response->getBody()->getContents(), TRUE);
        $device = new DeviceInfo();
        $device->setApplication($data['application'] ?? NULL)
            ->setAppSigner($data['appSigner'] ?? NULL)
            ->setAuthorizedEntity($data['authorizedEntity'] ?? NULL)
            ->setPlatform($data['platform'] ?? NULL)
            ->setRel($data['rel'] ?? NULL);
        return $device;
    }
}