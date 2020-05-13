<?php

namespace Mehdibo\Fcm\Notification;

/**
 * Class BasicNotification
 * @package Mehdibo\Fcm\Notification
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#notification
 */
class BasicNotification implements Notification
{

    private string $title;
    private string $body;
    private ?string $imageUrl;

    /**
     * @var mixed[]|null
     */
    private ?array $data;

    /**
     * BasicNotification constructor.
     * @param string $title
     * @param string $body
     * @param string|null $imageUrl
     * @param mixed[]|null $data
     */
    public function __construct(string $title, string $body, ?string $imageUrl = NULL, ?array $data = NULL)
    {
        $this->title = $title;
        $this->body = $body;
        $this->imageUrl = $imageUrl;
        $this->data = $data;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @param mixed[]|null $data
     * @return $this
     */
    public function setData(?array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getData(): ?array
    {
        return NULL;
    }

    public function getNotificationName(): string
    {
        return 'notification';
    }

    public function getNotificationBody(): array
    {
        $body = [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
        ];
        if ($this->getImageUrl())
            $body['image'] = $this->getImageUrl();
        return $body;
    }
}