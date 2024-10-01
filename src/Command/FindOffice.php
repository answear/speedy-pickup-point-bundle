<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Command;

use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Response\FindOfficeResponse;

class FindOffice extends AbstractCommand
{
    public function __construct(
        private Client $client,
        private RequestTransformer $transformer,
    ) {
    }

    public function findOffice(FindOfficeRequest $request): FindOfficeResponse
    {
        $httpRequest = $this->transformer->transform($request);
        $response = $this->client->request($httpRequest);

        $body = $this->getBody($response);

        return FindOfficeResponse::fromArray($body);
    }
}
