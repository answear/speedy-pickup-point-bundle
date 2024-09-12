<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Client;

use Answear\SpeedyBundle\ConfigProvider;
use Answear\SpeedyBundle\Exception\ServiceUnavailableException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private const CONNECTION_TIMEOUT = 10;
    private const TIMEOUT = 30;
    
    private ConfigProvider $configuration;
    private ClientInterface $client;

    public function __construct(
        ConfigProvider $configuration,
        ?ClientInterface $client = null
    ) {
        $this->configuration = $configuration;
        $this->client = $client ?? new GuzzleClient(
            [
                'base_uri' => $configuration->getUrl(),
                'timeout' => self::TIMEOUT,
                'connect_timeout' => self::CONNECTION_TIMEOUT
            ]
        );
    }

    public function request(Request $request): ResponseInterface
    {
        try {
            $response = $this->client->send($request);

            if ($response->getBody()->isSeekable()) {
                $response->getBody()->rewind();
            }
        } catch (GuzzleException $e) {
            throw new ServiceUnavailableException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }
}
