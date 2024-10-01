<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Client;

use Answear\SpeedyBundle\ConfigProvider;
use Answear\SpeedyBundle\Request\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;

class RequestTransformer
{
    public function __construct(
        private Serializer $serializer,
        private AuthenticationDecorator $decorator,
        private ConfigProvider $configuration,
    ) {
    }

    public function transform(Request $request): HttpRequest
    {
        $this->decorator->decorate($request);

        return new HttpRequest(
            $request->getMethod(),
            new Uri($this->configuration->getApiVersion() . $request->getEndpoint()),
            [
                'Content-type' => 'application/json',
            ],
            $this->serializer->serialize($request)
        );
    }
}
