<?php


namespace Mehdibo\Fcm\Tests;


use Mehdibo\Fcm\Exception\ServiceAccountFileNotFound;
use Mehdibo\Fcm\FcmNotifier;
use Mehdibo\Fcm\NotifierFactory;
use PHPUnit\Framework\TestCase;

class NotifierFactoryTest extends TestCase
{

    private string $serviceAccountPath = __DIR__.'/service_account_test.json';

    private string $projectId = 'project-id';

    public function testCreateNotifier():void
    {
        $notifier = NotifierFactory::create($this->serviceAccountPath, $this->projectId);
        $this->assertInstanceOf(FcmNotifier::class, $notifier);
    }

    public function testCreateNotifierWithNonExistingFile():void
    {
        $this->expectException(ServiceAccountFileNotFound::class);
        NotifierFactory::create('./doesnt_exist', $this->projectId);
    }

}