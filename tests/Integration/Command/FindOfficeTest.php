<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Integration\Command;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Command\FindOffice;
use Answear\SpeedyBundle\Exception\MalformedResponseException;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Response\FindOfficeResponse;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use Answear\SpeedyBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class FindOfficeTest extends TestCase
{
    use ConfigProviderTrait;
    use MockGuzzleTrait;

    private Client $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client($this->getConfiguration(), $this->setupGuzzleClient());
    }

    /**
     * @test
     */
    public function successfulFindOffice(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->findOffice(new FindOfficeRequest());

        $this->assertCount(1, $response->getOffices());
        $this->assertOffice($response);
    }

    /**
     * @test
     */
    public function responseWithError(): void
    {
        $this->expectException(MalformedResponseException::class);
        $this->expectExceptionMessage('Error response');

        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getErrorBody()));

        $response = $command->findOffice(new FindOfficeRequest());

        $this->assertCount(1, $response->getOffices());
        $this->assertOffice($response);
    }

    private function assertOffice(FindOfficeResponse $response): void
    {
        $office = $response->getOffices()->toArray()[0];

        $this->assertSame($office->id, 1);
        $this->assertSame($office->name, 'Office name');
        $this->assertSame($office->nameEn, 'English office name');
        $this->assertSame($office->address->postCode, '1200');
        $this->assertSame($office->address->streetName, 'Street name');
        $this->assertSame($office->address->siteName, 'Example city');
        $this->assertSame($office->address->latitude, 42.987654);
        $this->assertSame($office->address->longitude, 24.123456);
    }

    private function getCommand(): FindOffice
    {
        $transformer = new RequestTransformer(
            new Serializer(),
            new AuthenticationDecorator($this->getConfiguration()),
            $this->getConfiguration()
        );

        return new FindOffice($this->client, $transformer);
    }

    private function getSuccessfulBody(): string
    {
        return file_get_contents(__DIR__ . '/data/exampleResponse.json');
    }

    private function getErrorBody(): string
    {
        return \json_encode(
            [
                'error' => [
                    'context' => 'user.expired',
                    'message' => 'Потребителят е с изтекла валидност',
                    'id' => 'EE20210317183038558FZEMSKVR',
                    'code' => 1,
                ],
            ]
        );
    }
}
