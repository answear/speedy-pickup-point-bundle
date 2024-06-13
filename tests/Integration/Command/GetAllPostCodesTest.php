<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Integration\Command;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Command\GetAllPostCodes;
use Answear\SpeedyBundle\Request\GetAllPostCodesRequest;
use Answear\SpeedyBundle\Response\GetAllPostCodesResponse;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use Answear\SpeedyBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GetAllPostCodesTest extends TestCase
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
    public function successfulGetAllPostcodes(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->getAllPostCodes(new GetAllPostCodesRequest(100));

        $this->assertCount(9, $response->getPostCodes());
        $this->assertPostCodes($response);
    }

    /**
     * @test
     */
    public function responseWithError(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getErrorBody()));

        $response = $command->getAllPostCodes(new GetAllPostCodesRequest(100));

        $this->assertCount(0, $response->getPostCodes());
    }

    private function assertPostCodes(GetAllPostCodesResponse $response): void
    {
        $postCode = $response->getPostCodes()->get(0);

        $this->assertSame(
            '1000,68134',
            implode(
                ',',
                [
                    $postCode->postCode,
                    $postCode->siteId,
                ],
            )
        );
    }

    private function getCommand(): GetAllPostCodes
    {
        $transformer = new RequestTransformer(
            new Serializer(),
            new AuthenticationDecorator($this->getConfiguration()),
            $this->getConfiguration()
        );

        return new GetAllPostCodes($this->client, $transformer);
    }

    private function getSuccessfulBody(): string
    {
        return file_get_contents(__DIR__ . '/data/getAllPostCodesResponse.csv');
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
