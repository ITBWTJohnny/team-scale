<?php

namespace App\Services;

class IpContinentDetector
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    private $apiUri = 'http://api.ipstack.com/';

    private $apiKey = '64ad683e8df74f2d919ebb2eab3e2571';

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function detectContinent(string $ip): ?string
    {
        $url = $this->apiUri . $ip .'?access_key='.$this->apiKey;
        $response = $this->client->request('GET', $url);
        $data = json_decode((string)$response->getBody(), true);


        if (!empty($data['continent_code'])) {
            return $data['continent_code'];
        }

         throw new \Exception('Api error '. json_encode($data));
    }
}