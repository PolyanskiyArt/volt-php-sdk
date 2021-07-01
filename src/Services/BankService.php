<?php


namespace LJJackson\Volt\Services;


use GuzzleHttp\RequestOptions;
use LJJackson\Volt\Entities\AccessToken;
use LJJackson\Volt\Entities\Bank;

class BankService extends BaseService
{
    /**
     * @param AccessToken $token
     * @return Bank[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieveAll(AccessToken $token): array
    {
        $response = $this->get('banks', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $token->getAccessToken()
            ]
        ]);

        $results = json_decode($response->getBody()->getContents(), true);

        return array_map(fn ($bank) => new Bank($bank), $results);
    }
}