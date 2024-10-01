<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit\Client;

use Answear\SpeedyBundle\Client\AuthenticationDecorator;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Tests\ConfigProviderTrait;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AuthenticationDecoratorTest extends TestCase
{
    use ConfigProviderTrait;

    #[Test]
    public function requestAuthentication(): void
    {
        $request = new FindOfficeRequest();
        $configuration = $this->getConfiguration();

        $authenticator = new AuthenticationDecorator($configuration);
        $authenticator->decorate($request);

        $this->assertSame($configuration->username, $request->userName);
        $this->assertSame($configuration->password, $request->password);
        $this->assertSame($configuration->language, $request->language);
        $this->assertSame($configuration->clientSystemId, $request->clientSystemId);
    }
}
