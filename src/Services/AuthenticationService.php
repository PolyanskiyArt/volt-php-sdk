<?php

namespace LJJackson\Volt\Services;

use GuzzleHttp\RequestOptions;
use LJJackson\Volt\Entities\AccessToken;

class AuthenticationService extends BaseService
{
    /**
     * Authenticate the API configuration details against the oauth endpoint to retrieve an access token.
     *
     * @return AccessToken
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @link https://docs.volt.io/docs/first_payment/authenticate
     */
    public function authenticate(): AccessToken
    {
        $response = $this->post('oauth', [
            RequestOptions::JSON => [
                'client_id' => $this->apiConfig->getClientId(),
                'client_secret' => $this->apiConfig->getClientSecret(),
                'username' => $this->apiConfig->getUsername(),
                'password' => $this->apiConfig->getPassword(),
                'grant_type' => 'password'
            ]
        ]);

        return new AccessToken(json_decode($response->getBody()->getContents(), true));
    }
}