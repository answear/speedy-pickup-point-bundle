<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit\Client;

use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Request\Request;
use PHPUnit\Framework\TestCase;

class SerializerTest extends TestCase
{
    /**
     * @test
     * @dataProvider provider
     */
    public function requestAuthentication(Request $request, string $expectedBody): void
    {
        $serializer = new Serializer();

        $this->assertSame($expectedBody, $serializer->serialize($request));
    }

    public function provider(): iterable
    {
        yield 'requestFields' => [
            new FindOfficeRequest(100, 1, 'office_name', 100),
            '{"countryId":100,"siteId":1,"name":"office_name","limit":100}',
        ];

        yield 'skipNullValues' => [
            new FindOfficeRequest(100, null, 'office_name'),
            '{"countryId":100,"name":"office_name"}',
        ];

        yield 'serializeAuthenticationData' => [
            $this->getAuthenticatedRequest(),
            '{"userName":"username","password":"password","language":"language","clientSystemId":999}',
        ];
    }

    private function getAuthenticatedRequest(): Request
    {
        $request = new FindOfficeRequest();
        $request->setUserName('username');
        $request->setPassword('password');
        $request->setLanguage('language');
        $request->setClientSystemId(999);

        return $request;
    }
}
