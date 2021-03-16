<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Integration\Command;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Client\Client;
use Answear\SpeedyBundle\Client\RequestTransformer;
use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Command\FindOffice;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use Monolog\Test\TestCase;

class FindOfficeTest extends TestCase
{
    use ConfigProviderTrait;

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
        $this->markTestSkipped();

        $client = new Client($this->getConfiguration());
        $transformer = new RequestTransformer(
            new Serializer(),
            new AuthenticationDecorator($this->getConfiguration()),
            $this->getConfiguration()
        );

        $action = new FindOffice($client, $transformer);
        $response = $action->findOffice(new FindOfficeRequest(100, null, null, 1));

        $this->assertCount(1, $response->getOffices());
    }

    private function setupAction(): void
    {
    }
}
