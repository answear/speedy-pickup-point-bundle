<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Client;

use Answear\SpeedyBundle\ConfigProvider;
use Answear\SpeedyBundle\Request\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;

class RequestTransformer
{
    private Serializer $serializer;
    private AuthenticationDecorator $decorator;
    private ConfigProvider $configuration;

    public function __construct(
        Serializer $serializer,
        AuthenticationDecorator $decorator,
        ConfigProvider $configuration
    ) {
        $this->serializer = $serializer;
        $this->decorator = $decorator;
        $this->configuration = $configuration;
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
