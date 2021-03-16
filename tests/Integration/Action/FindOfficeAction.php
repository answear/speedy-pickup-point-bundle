<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Integration\Action;

use Answear\SpeedyBundle\Action\FindOffice;
use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\ConfigProvider;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Monolog\Test\TestCase;

class FetchPickupPoints extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setupAction();
    }

    /**
     * @test
     */
    public function test(): void
    {
        $configProvider = new ConfigProvider('999101', '9642589187', 'BG');

        $client = new Client($configProvider);
        $transformer = new RequestTransformer(
            new Serializer(),
            new AuthenticationDecorator($configProvider),
            $configProvider
        );

        $action = new FindOffice($client, $transformer);
        $response = $action->findOffice(new FindOfficeRequest(100, null, null, 1));

        $this->assertCount(1, $response->getOffices());
    }

    private function setupAction(): void
    {
    }
}
