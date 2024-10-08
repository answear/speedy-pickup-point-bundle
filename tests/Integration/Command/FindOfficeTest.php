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
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function successfulFindOffice(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->findOffice(new FindOfficeRequest());

        $this->assertCount(1, $response->offices);
        $this->assertOffice($response);
    }

    #[Test]
    public function responseWithError(): void
    {
        $this->expectException(MalformedResponseException::class);
        $this->expectExceptionMessage('Error response');

        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getErrorBody()));

        $response = $command->findOffice(new FindOfficeRequest());

        $this->assertCount(1, $response->offices);
        $this->assertOffice($response);
    }

    private function assertOffice(FindOfficeResponse $response): void
    {
        $office = $response->offices->get(0);

        $this->assertNotNull($office);
        $this->assertSame($office->id, 1);
        $this->assertSame($office->name, 'Office name');
        $this->assertSame($office->nameEn, 'English office name');
        $this->assertSame($office->address->postCode, '1200');
        $this->assertSame($office->address->streetName, 'Street name');
        $this->assertSame($office->address->siteName, 'Example city');
        $this->assertSame($office->address->latitude, 42.987654);
        $this->assertSame($office->address->longitude, 24.123456);
        $this->assertCount(9, $office->workingTimeSchedule);

        $this->assertSame('08:30', $office->openingSchedule->weekday->from);
        $this->assertSame('19:30', $office->openingSchedule->weekday->to);
        $this->assertFalse($office->openingSchedule->weekday->isClosed());
        $this->assertSame('08:30', $office->openingSchedule->saturday->from);
        $this->assertSame('14:30', $office->openingSchedule->saturday->to);
        $this->assertFalse($office->openingSchedule->saturday->isClosed());
        $this->assertSame('00:00', $office->openingSchedule->sunday->from);
        $this->assertSame('00:00', $office->openingSchedule->sunday->to);
        $this->assertTrue($office->openingSchedule->sunday->isClosed());
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
        return file_get_contents(__DIR__ . '/data/findOfficeResponse.json');
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
            ],
            JSON_THROW_ON_ERROR
        );
    }
}
