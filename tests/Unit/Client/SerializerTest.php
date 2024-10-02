<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit\Client;

use Answear\SpeedyBundle\Client\Serializer;
use Answear\SpeedyBundle\Request\FindOfficeRequest;
use Answear\SpeedyBundle\Request\Request;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SerializerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    #[DataProvider('provider')]
    public function requestAuthentication(Request $request, string $expectedBody): void
    {
        $serializer = new Serializer();

        $this->assertSame($expectedBody, $serializer->serialize($request));
    }

    public static function provider(): iterable
    {
        yield 'requestFields' => [
            self::getAuthenticatedRequest(100, 1, 'office_name', 100),
            '{"countryId":100,"siteId":1,"name":"office_name","limit":100,"userName":"username","password":"password","language":"language","clientSystemId":999}',
        ];

        yield 'skipNullValues' => [
            self::getAuthenticatedRequest(100, null, 'office_name'),
            '{"countryId":100,"name":"office_name","userName":"username","password":"password","language":"language","clientSystemId":999}',
        ];

        yield 'serializeAuthenticationData' => [
            self::getAuthenticatedRequest(),
            '{"userName":"username","password":"password","language":"language","clientSystemId":999}',
        ];
    }

    private static function getAuthenticatedRequest(
        ?int $countryId = null,
        ?int $siteId = null,
        ?string $name = null,
        ?int $limit = null,
    ): Request {
        $request = new FindOfficeRequest($countryId, $siteId, $name, $limit);
        $request->userName = 'username';
        $request->password = 'password';
        $request->language = 'language';
        $request->clientSystemId = 999;

        return $request;
    }
}
