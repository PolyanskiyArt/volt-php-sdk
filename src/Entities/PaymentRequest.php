<?php


namespace LJJackson\Volt\Entities;


use JetBrains\PhpStorm\Pure;

class PaymentRequest
{
    public const NEW_PAYMENT = 'NEW_PAYMENT';
    public const BANK_REDIRECT = 'BANK_REDIRECT';
    public const CANCELLED_BY_USER = 'CANCELLED_BY_USER';
    public const ABANDONED_BY_USER = 'ABANDONED_BY_USER';
    public const FAILED = 'FAILED';
    public const REFUSED_BY_BANK = 'REFUSED_BY_BANK';
    public const ERROR_AT_BANK = 'ERROR_AT_BANK';
    public const AUTHORISED_BY_USER = 'AUTHORISED_BY_USER';
    public const DELAYED_AT_BANK = 'DELAYED_AT_BANK';
    public const COMPLETED = 'COMPLETED';
    public const PENDING = 'PENDING';

    protected string $id;
    protected ?string $uniqueReference;
    protected ?string $status;
    private bool $production = true;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->uniqueReference = $data['uniqueReference'] ?? null;
        $this->status = $data['status'] ?? null;
    }

    public static function fromRedirect(string $request): PaymentRequest
    {
        return new self(json_decode(base64_decode($request), true));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUniqueReference(): ?string
    {
        return $this->uniqueReference;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    #[Pure]
    public function isNew(): bool
    {
        return $this->getStatus() === self::NEW_PAYMENT;
    }

    #[Pure]
    public function isBankRedirect(): bool
    {
        return $this->getStatus() === self::BANK_REDIRECT;
    }

    #[Pure]
    public function isCancelled(): bool
    {
        return $this->getStatus() === self::CANCELLED_BY_USER;
    }

    #[Pure]
    public function isFailed(): bool
    {
        return $this->getStatus() === self::FAILED;
    }

    #[Pure]
    public function isAuthorised(): bool
    {
        return $this->getStatus() === self::AUTHORISED_BY_USER;
    }

    #[Pure]
    public function isAbandoned(): bool
    {
        return $this->getStatus() === self::ABANDONED_BY_USER;
    }

    #[Pure]
    public function isDelayedByBank(): bool
    {
        return $this->getStatus() === self::DELAYED_AT_BANK;
    }

    #[Pure]
    public function hasErrorAtBank(): bool
    {
        return $this->getStatus() === self::ERROR_AT_BANK;
    }

    #[Pure]
    public function isRefusedByBank(): bool
    {
        return $this->getStatus() === self::REFUSED_BY_BANK;
    }

    #[Pure]
    public function isComplete(): bool
    {
        return $this->getStatus() === self::COMPLETED;
    }

    #[Pure]
    public function isPending(): bool
    {
        return in_array($this->getStatus(), [
            self::PENDING,
            self::DELAYED_AT_BANK,
            self::AUTHORISED_BY_USER,
            self::BANK_REDIRECT,
        ]);
    }

    #[Pure]
    public function isTerminal(): bool
    {
        return $this->isPending() === false;
    }

    #[Pure]
    public function getCheckoutToken(): string
    {
        return base64_encode($this->getId());
    }

    #[Pure]
    public function getRedirectUri(): string
    {
        if ($this->production) {
            return "https://checkout.volt.io/{$this->getCheckoutToken()}";
        }

        return "https://checkout.sandbox.volt.io/{$this->getCheckoutToken()}";
    }

    public function setSandbox(): self
    {
        $this->production = false;

        return $this;
    }
}