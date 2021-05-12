<?php

namespace LJJackson\Volt\Entities;

class AccessToken
{
    private string $accessToken;
    private int $expiresIn;
    private string $tokenType;
    private string $refreshToken;

    public function __construct(array $response)
    {
        $this->accessToken = $response['access_token'];
        $this->expiresIn = $response['expires_in'];
        $this->tokenType = $response['token_type'];
        $this->refreshToken = $response['refresh_token'];
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}