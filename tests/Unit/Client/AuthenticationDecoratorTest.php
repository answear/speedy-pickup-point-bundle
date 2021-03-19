<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit\Client;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use PHPUnit\Framework\TestCase;

class AuthenticationDecoratorTest extends TestCase
{
    use ConfigProviderTrait;

    /**
     * @test
     */
    public function requestAuthentication(): void
    {
        $request = new FindOfficeRequest();
        $configuration = $this->getConfiguration();

        $authenticator = new AuthenticationDecorator($configuration);
        $authenticator->decorate($request);

        $this->assertSame($configuration->getUsername(), $request->getUserName());
        $this->assertSame($configuration->getPassword(), $request->getPassword());
        $this->assertSame($configuration->getLanguage(), $request->getLanguage());
        $this->assertSame($configuration->getClientSystemId(), $request->getClientSystemId());
    }
}
