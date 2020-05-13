<?php


namespace Mehdibo\Fcm\Tests\Notification;


use Mehdibo\Fcm\Notification\BasicNotification;
use PHPUnit\Framework\TestCase;

class BasicNotificationTest extends TestCase
{

    private BasicNotification $notif;

    private const NOTIF_NAME = 'notification';

    private const DATA = [
        'title' => 'title_is_here',
        'body' => 'body_goes_here',
        'imageUrl' => 'this_should_be_an_image_url',
        'data' => ['data_key' => 'data_value']
    ];

    private const EXPECTED_BODY = [
        'title' => self::DATA['title'],
        'body' => self::DATA['body'],
        'image' => self::DATA['imageUrl'],
    ];

    public function setUp(): void
    {
        $this->notif = new BasicNotification(
            self::DATA['title'],
            self::DATA['body'],
            self::DATA['imageUrl'],
            self::DATA['data']
        );
    }

    public function testConstruct():void
    {
        $this->assertEquals(self::DATA['title'], $this->notif->getTitle());
        $this->assertEquals(self::DATA['body'], $this->notif->getBody());
        $this->assertEquals(self::DATA['imageUrl'], $this->notif->getImageUrl());
        $this->assertEquals(self::DATA['data'], $this->notif->getData());
    }

    public function testGetNotificationBody()
    {
        $expectedBody = self::EXPECTED_BODY;
        $this->assertEquals($expectedBody, $this->notif->getNotificationBody());
    }

    public function testSetImageUrl()
    {
        $newValue = 'this_is_the_new_value';
        $expectedBody = self::EXPECTED_BODY;
        $expectedBody['image'] = $newValue;
        $this->notif->setImageUrl($newValue);
        $this->assertEquals($newValue, $this->notif->getImageUrl());
        $this->assertEquals($expectedBody, $this->notif->getNotificationBody());
    }

    public function testGetNotificationName()
    {
        $this->assertEquals(self::NOTIF_NAME, $this->notif->getNotificationName());
    }

    public function testSetTitle()
    {
        $newValue = 'this_is_the_new_value';
        $expectedBody = self::EXPECTED_BODY;
        $expectedBody['title'] = $newValue;
        $this->notif->setTitle($newValue);
        $this->assertEquals($newValue, $this->notif->getTitle());
        $this->assertEquals($expectedBody, $this->notif->getNotificationBody());
    }

    public function testSetData()
    {
        $newValue = ['new_key', 'this_is_the_new_value'];
        $this->notif->setData($newValue);
        $this->assertEquals($newValue, $this->notif->getData());
    }

    public function testSetBody()
    {
        $newValue = 'this_is_the_new_value';
        $expectedBody = self::EXPECTED_BODY;
        $expectedBody['body'] = $newValue;
        $this->notif->setBody($newValue);
        $this->assertEquals($newValue, $this->notif->getBody());
        $this->assertEquals($expectedBody, $this->notif->getNotificationBody());
    }
}