<?php


namespace LJJackson\Volt;


use JetBrains\PhpStorm\Pure;

class VoltApiConfig
{
    private string $clientId;
    private string $clientSecret;
    private string $apiUsername;
    private string $apiPassword;
    private bool $production = true;

    public function __construct(string $clientId, string $clientSecret, string $apiUsername, string $apiPassword)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiUsername = $apiUsername;
        $this->apiPassword = $apiPassword;
    }

    public function getUsername(): string
    {
        return $this->apiUsername;
    }

    public function getPassword(): string
    {
        return $this->apiPassword;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function isProduction(): bool
    {
        return $this->production;
    }

    public function isSandbox(): bool
    {
        return $this->isProduction() === false;
    }

    public function setSandbox(): VoltApiConfig
    {
        $this->production = false;
        return $this;
    }

    public function setProduction(): VoltApiConfig
    {
        $this->production = true;
        return $this;
    }
}