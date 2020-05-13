<?php


namespace Mehdibo\Fcm;


use Mehdibo\Fcm\Auth\GoogleAuth;

class NotifierFactory
{

    /**
     * @param string $serviceAccountCredentials
     * @param string $projectId
     * @return Notifier|null
     * @throws Exception\ServiceAccountFileNotFound
     * @throws Exception\ServiceAccountFileNotValid
     */
    public static function create(string $serviceAccountCredentials, string $projectId):?Notifier
    {
        $googleAuth = new GoogleAuth($serviceAccountCredentials, new \Google_Client());
        $httpClient = $googleAuth->getAuthorizedClient();
        return new Notifier($projectId, $httpClient);
    }

}