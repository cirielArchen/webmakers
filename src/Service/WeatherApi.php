<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\ServerException;

class WeatherApi
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly SerializerInterface $serializer,
        ){
    }

    public function getWeather(string $latitude, string $longitude, string $units = 'metric', string $lang = 'pl')
    {
        $apiKey = $_ENV['WEATHER_API_KEY'];
        $baseUrl = $_ENV['WEATHER_BASE_URL'];

        $url = $baseUrl . 
            '?lat=' . $latitude . 
            '&lon=' . $longitude . 
            '&appid=' . $apiKey . 
            '&units=' . $units .
            '&lang=' . $lang;

        $response = $this->client->request(
            'GET',
            $url
        );
        
        if ($response->getStatusCode() >= 400) {
            throw new ClientException($response);
        }

        if ($response->getStatusCode() >= 500) {
            throw new ServerException($response);
        }

        return $response->getContent();
    }
}

