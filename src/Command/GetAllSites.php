<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Command;

use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Exception\MalformedResponseException;
use Answear\SpeedyBundle\Request\GetAllSitesRequest;
use Answear\SpeedyBundle\Response\GetAllSitesResponse;

class GetAllSites extends AbstractCommand
{
    private Client $client;
    private RequestTransformer $transformer;

    public function __construct(Client $client, RequestTransformer $transformer)
    {
        $this->client = $client;
        $this->transformer = $transformer;
    }

    public function getAllSites(GetAllSitesRequest $request): GetAllSitesResponse
    {
        $httpRequest = $this->transformer->transform($request);
        $response = $this->client->request($httpRequest);

        try {
            $result = GetAllSitesResponse::fromCsv($response->getBody()->getContents());
        } catch (\Throwable $throwable) {
            throw new MalformedResponseException($throwable->getMessage(), $response, $throwable);
        }

        return $result;
    }
}
