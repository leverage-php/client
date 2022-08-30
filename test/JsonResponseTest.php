<?php

use GuzzleHttp\Psr7\Response;
use Leverage\Client\JsonResponse;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    private const DATA = [
        'key' => 'val',
    ];

    private JsonResponse $response;

    public function setUp(): void
    {
        $this->response = new JsonResponse(
            response: new Response,
            data: self::DATA,
        );
    }

    public function testVersion(): void
    {
        $version = 'version';
        $response = $this->response->withProtocolVersion($version);
        self::assertSame($version, $response->getProtocolVersion());
        self::assertSame(self::DATA, $response->getData());
    }

    public function testHeader(): void
    {
        $name = 'name';
        $value = 'value';
        $response = $this->response->withHeader($name, $value);
        self::assertTrue($response->hasHeader($name));
        self::assertSame($value, $response->getHeader($name)[0]);
        self::assertSame(self::DATA, $response->getData());
    }

    public function testStatus(): void
    {
        $code = 123;
        $reason = 'reason';
        $response = $this->response->withStatus($code, $reason);
        self::assertSame($code, $response->getStatusCode());
        self::assertSame($reason, $response->getReasonPhrase());
        self::assertSame(self::DATA, $response->getData());
    }

    public function testData(): void
    {
        self::assertSame(self::DATA, $this->response->getData());
    }
}
