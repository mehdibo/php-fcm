<?php

namespace Mehdibo\Fcm\Tests\Receiver;

use Mehdibo\Fcm\Receiver\Condition;
use Mehdibo\Fcm\Receiver\Device;
use Mehdibo\Fcm\Receiver\Receiver;
use PHPUnit\Framework\TestCase;

class DeviceTest extends TestCase
{

    private string $targetName = 'token';

    private string $targetValue = 'any_value_here';

    private Receiver $receiver;

    public function setUp(): void
    {
        $this->receiver = new Device($this->targetValue);
    }

    public function testGetTargetName():void
    {
        $this->assertEquals($this->targetName, $this->receiver->getTargetName());
    }

    public function testGetTargetValue():void
    {
        $this->assertEquals($this->targetValue, $this->receiver->getTargetValue());
    }

}
