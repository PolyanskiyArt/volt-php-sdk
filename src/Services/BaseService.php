<?php


namespace LJJackson\Volt\Services;

use GuzzleHttp\Client;
use LJJackson\Volt\VoltApi;
use LJJackson\Volt\VoltApiConfig;

class BaseService extends Client
{

    protected VoltApi $api;
    protected VoltApiConfig $apiConfig;

    public function __construct(VoltApi $api)
    {
        parent::__construct([
            'base_uri' => $api->getConfig()->isProduction() ? 'https://api.volt.io' : 'https://api.sandbox.volt.io/',
        ]);

        $this->api = $api;
        $this->apiConfig = $api->getConfig();
    }

}