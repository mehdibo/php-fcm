<?php


namespace Mehdibo\Fcm\Auth;


use GuzzleHttp\ClientInterface;
use Mehdibo\Fcm\Exception\ServiceAccountFileNotFound;
use Mehdibo\Fcm\Exception\ServiceAccountFileNotValid;

class GoogleAuth
{

    private const SCOPES = [
        'https://www.googleapis.com/auth/firebase.messaging',
    ];

    private const ENV_NAME = 'GOOGLE_APPLICATION_CREDENTIALS';

    private const ERROR_MESSAGES = [
        'invalid_file' => 'Could not load the default credentials. Browse to https://developers.google.com/accounts/docs/application-default-credentials for more information',
    ];

    private string $serviceAccountCredentials;

    private \Google_Client $googleClient;

    /**
     * @param string $serviceAccountCredentials
     * @param \Google_Client $googleClient
     * @throws ServiceAccountFileNotFound
     */
    public function __construct(string $serviceAccountCredentials, \Google_Client $googleClient)
    {
        if (!file_exists($serviceAccountCredentials) || !is_readable($serviceAccountCredentials))
            throw new ServiceAccountFileNotFound('The service account file is not found or not readable');
        $this->serviceAccountCredentials = $serviceAccountCredentials;
        $this->googleClient = $googleClient;
    }

    /**
     * @return ClientInterface|null
     * @throws ServiceAccountFileNotValid
     */
    public function getAuthorizedClient():?ClientInterface
    {
        $this->googleClient->useApplicationDefaultCredentials();
        $this->googleClient->addScope(self::SCOPES);
        // Couldn't find another way to inject the service account JSON file path
        // To the Google_Client class without an env var
        putenv(self::ENV_NAME.'='.$this->serviceAccountCredentials);
        try {
            // Try to authorize and catch vague exceptions
            // And turn them into predictable ones
            $client = $this->googleClient->authorize();
        } catch (\DomainException $e)
        {
            if ($e->getMessage() === self::ERROR_MESSAGES['invalid_file'])
                throw new ServiceAccountFileNotValid($e->getMessage());
            return NULL;
        } catch (\InvalidArgumentException $e)
        {
            throw new ServiceAccountFileNotValid($e->getMessage());
        }
        // We immediately remove the env var
        putenv(self::ENV_NAME);
        return $client;
    }

}