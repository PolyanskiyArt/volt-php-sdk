<?php

namespace LJJackson\Volt\Webhooks;

class RequestVerifier
{
    protected string $content;
    protected string $timed;
    protected string $secret;
    protected string $version;
    protected string $expected;

    public function __construct(string $content, string $timed, string $secret, string $version, string $signed)
    {
        $this->content = $content;
        $this->timed = $timed;
        $this->secret = $secret;
        $this->version = $version;
        $this->expected = $signed;
    }

    protected function getCheckString(): string
    {
        return sprintf('%s|%s|%s', $this->content, $this->timed, $this->version);
    }

    protected function getHashedCheckString(): string
    {
        return hash_hmac('sha256', $this->getCheckString(), $this->secret);
    }

    public function isValid(): bool
    {
        return hash_equals($this->expected, $this->getHashedCheckString());
    }
}