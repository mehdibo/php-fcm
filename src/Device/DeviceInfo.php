<?php


namespace Mehdibo\Fcm\Device;


class DeviceInfo
{

    private ?string $application;
    private ?string $authorizedEntity;
    private ?string $platform;
    private ?string $appSigner;
    private ?array $rel;

    /**
     * DeviceInfo constructor.
     * @param string|null $application
     * @param string|null $authorizedEntity
     * @param string|null $platform
     * @param string|null $appSigner
     * @param array|null $rel
     */
    public function __construct(
        ?string $application = NULL,
        ?string $authorizedEntity = NULL,
        ?string $platform = NULL,
        ?string $appSigner = NULL,
        ?array $rel = NULL
    ) {
        $this->application = $application;
        $this->authorizedEntity = $authorizedEntity;
        $this->platform = $platform;
        $this->appSigner = $appSigner;
        $this->rel = $rel;
    }

    /**
     * @return string|null
     */
    public function getApplication(): ?string
    {
        return $this->application;
    }

    /**
     * @param string|null $application
     */
    public function setApplication(?string $application): self
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorizedEntity(): ?string
    {
        return $this->authorizedEntity;
    }

    /**
     * @param string|null $authorizedEntity
     */
    public function setAuthorizedEntity(?string $authorizedEntity): self
    {
        $this->authorizedEntity = $authorizedEntity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    /**
     * @param string|null $platform
     */
    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppSigner(): ?string
    {
        return $this->appSigner;
    }

    /**
     * @param string|null $appSigner
     */
    public function setAppSigner(?string $appSigner): self
    {
        $this->appSigner = $appSigner;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getRel(): ?array
    {
        return $this->rel;
    }

    /**
     * @param array|null $rel
     */
    public function setRel(?array $rel): self
    {
        $this->rel = $rel;
        return $this;
    }

}