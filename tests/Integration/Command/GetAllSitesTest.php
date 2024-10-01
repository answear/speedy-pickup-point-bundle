<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Integration\Command;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Command\GetAllSites;
use Answear\SpeedyBundle\Request\GetAllSitesRequest;
use Answear\SpeedyBundle\Response\GetAllSitesResponse;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use Answear\SpeedyBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GetAllSitesTest extends TestCase
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
    public function successfulGetAllSites(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->getAllSites(new GetAllSitesRequest());

        $this->assertCount(13, $response->sites);
        $this->assertSites($response);
    }

    /**
     * @test
     */
    public function responseWithError(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getErrorBody()));

        $response = $command->getAllSites(new GetAllSitesRequest());

        $this->assertCount(0, $response->sites);
    }

    private function assertSites(GetAllSitesResponse $response): void
    {
        $site = $response->sites->get(0);

        $this->assertSame(
            '642202552,642,0,s.,s.,1 DECEMBRIE,1 DECEMBRIE,COM. 1 DECEMBRIE,COM. 1 DECEMBRIE,ILFOV,ILFOV,077005,1,26.060031,44.288061,1111110,959,959',
            implode(
                ',',
                [
                    $site->id,
                    $site->countryId,
                    $site->mainSiteId,
                    $site->type,
                    $site->typeEn,
                    $site->name,
                    $site->nameEn,
                    $site->municipality,
                    $site->municipalityEn,
                    $site->region,
                    $site->regionEn,
                    $site->postCode,
                    $site->addressNomenclature,
                    $site->x,
                    $site->y,
                    $site->servingDays,
                    $site->servingOfficeId,
                    $site->servingHubOfficeId,
                ],
            )
        );
    }

    private function getCommand(): GetAllSites
    {
        $transformer = new RequestTransformer(
            new Serializer(),
            new AuthenticationDecorator($this->getConfiguration()),
            $this->getConfiguration()
        );

        return new GetAllSites($this->client, $transformer);
    }

    private function getSuccessfulBody(): string
    {
        return file_get_contents(__DIR__ . '/data/getAllSitesResponse.csv');
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
