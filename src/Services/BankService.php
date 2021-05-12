<?php


namespace LJJackson\Volt\Services;


use GuzzleHttp\RequestOptions;
use LJJackson\Volt\Entities\AccessToken;

class BankService extends BaseService
{
    /**
     * TODO Create entity.
     *
     * @param AccessToken $token
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieveAll(AccessToken $token)
    {
        $response = $this->get('banks', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $token->getAccessToken()
            ]
        ]);

        $results = json_decode($response->getBody()->getContents(), true);

        return $results;
    }
}