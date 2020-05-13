<?php


namespace Mehdibo\Fcm\Notification\Android;


use Mehdibo\Fcm\Notification\Notification;

/**
 * Class AndroidConfig
 * @package Mehdibo\Fcm\Notification\Android
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidconfig
 */
abstract class AndroidConfig implements Notification
{
    /**
     * @var mixed[]
     */
    private array $config = [
        'collapse_key' => NULL,
        'priority' => NULL,
        'ttl' => NULL,
        'restricted_package_name' => NULL,
        'data' => NULL,
    ];

    public function getNotificationName(): string
    {
        return 'android';
    }

    public function getNotificationBody(): array
    {
        $body = [];
        foreach ($this->config as $key => $value) {
            if ($value === NULL)
                continue;
            $body[$key] = $value;
        }
        return $body;
    }

    public function getData(): ?array
    {
        return NULL;
    }

    public function setCollapseKey(?string $key):self
    {
        $this->config['collapse_key'] = $key;
        return $this;
    }

    public function setPriority(?Priority\Priority $priority):self
    {
        $this->config['priority'] = ($priority !== NULL ) ? $priority->getValue() : NULL;
        return $this;
    }

    public function setTtl(?int $ttl):self
    {
        $this->config['ttl'] = $ttl;
        return $this;
    }

    public function setRestrictedPackageName(?string $restrictedPackageName):self
    {
        $this->config['restricted_package_name'] = $restrictedPackageName;
        return $this;
    }

    /**
     * @param mixed[] $data
     * @return $this
     */
    public function setData(?array $data):self
    {
        $this->config['data'] = $data;
        return $this;
    }
}