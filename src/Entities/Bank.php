<?php


namespace LJJackson\Volt\Entities;


class Bank
{
    private string $id;
    private string $name;
    private string $country;
    private string $logo;
    private string $icon;
    private array $currencies;
    private array $providers;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->name = $response['name'];
        $this->country = $response['country']['id'];
        $this->logo = $response['logo'];
        $this->icon = $response['icon'];
        $this->currencies = $response['supportedCurrencies'];
        $this->providers = $response['providedBy'] ?? [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return string[]
     */
    public function getCurrencies(): array
    {
        return $this->currencies;
    }

    /**
     * @return string[]
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}