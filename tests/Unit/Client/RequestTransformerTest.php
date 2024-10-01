<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit\Client;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Request\Request;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RequestTransformerTest extends TestCase
{
    use ConfigProviderTrait;

    private RequestTransformer $transformer;
    private Serializer|MockObject $serializer;

    public function setUp(): void
    {
        parent::setUp();

        $this->serializer = $this->createMock(Serializer::class);
        $this->transformer = new RequestTransformer(
            $this->serializer,
            $this->createMock(AuthenticationDecorator::class),
            $this->getConfiguration()
        );
    }

    #[Test]
    public function requestTransformed(): void
    {
        $request = new FindOfficeRequest();
        $this->serializer->expects($this->once())
            ->method('serialize')
            ->with($request)
            ->willReturn('{"foo":"bar"}');

        $httpRequest = $this->transformer->transform($request);

        $this->assertSame($request->getMethod(), $httpRequest->getMethod());
        $this->assertSame($this->expectedPath($request), $httpRequest->getUri()->getPath());
        $this->assertSame(['application/json'], $httpRequest->getHeader('Content-type'));
        $this->assertSame('{"foo":"bar"}', $httpRequest->getBody()->getContents());
    }

    private function expectedPath(Request $request): string
    {
        return $this->getConfiguration()->getApiVersion() . $request->getEndpoint();
    }
}
