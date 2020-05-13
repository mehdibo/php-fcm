<?php


namespace Mehdibo\Fcm\Notification\Android;


use Mehdibo\Fcm\Notification\Notification;

/**
 * Class AndroidNotification
 * @package Mehdibo\Fcm\Notification\Android
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#AndroidNotification
 */
class AndroidNotification extends AndroidConfig implements Notification
{

    /**
     * @var mixed[]
     */
    private array $notification = [
        'title' => NULL,
        'body' => NULL,
        'icon' => NULL,
        'color' => NULL,
        'sound' => NULL,
        'tag' => NULL,
        'click_action' => NULL,
        'body_loc_args' => NULL,
        'title_loc_key' => NULL,
        'title_loc_args' => NULL,
        'channel_id' => NULL,
        'ticker' => NULL,
        'sticky' => NULL,
        'event_time' => NULL,
        'local_only' => NULL,
        'notification_priority' => NULL,
        'default_sound' => NULL,
        'default_vibrate_timings' => NULL,
        'default_light_settings' => NULL,
        'vibrate_timings' => NULL,
        'visibility' => NULL,
        'notification_count' => NULL,
        'light_settings' => NULL,
        'image' => NULL,
    ];

    /**
     * AndroidNotification constructor.
     * @param string $title
     * @param string $body
     * @param string|null $icon
     * @param mixed[] $data
     */
    public function __construct(string $title, string $body, ?string $icon = NULL, ?array $data = NULL)
    {
        $this->notification['title'] = $title;
        $this->notification['body'] = $body;
        $this->notification['icon'] = $icon;
        $this->setData($data);
    }

    public function setTitle(?string $title):self
    {
        $this->notification['title'] = $title;
        return $this;
    }

    public function setBody(?string $body):self
    {
        $this->notification['body'] = $body;
        return $this;
    }

    public function setIcon(?string $icon):self
    {
        $this->notification['icon'] = $icon;
        return $this;
    }

    public function setColor(?string $color):self
    {
        $this->notification['color'] = $color;
        return $this;
    }

    public function getNotificationBody(): array
    {
        $body = parent::getNotificationBody();
        $body['notification'] = [];
        foreach ($this->notification as $key => $value) {
            if ($value === NULL)
                continue;
            $body['notification'][$key] = $value;
        }
        return $body;
    }
}