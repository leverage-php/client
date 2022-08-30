<?php

declare(strict_types=1);

use Leverage\Client\JsonRequest;
use Leverage\Encoder\JsonTrait;
use PHPUnit\Framework\TestCase;

class JsonRequestTest extends TestCase
{
    use JsonTrait;

    private const METHOD = 'GET';
    private const URI = 'https://www.example.com';
    private const HEADER_KEY = 'header-key';
    private const HEADER_VAL = 'header-val';
    private const DATA = [
        'data-key' => 'data-val',
    ];

    private JsonRequest $request;

    public function setUp(): void
    {
        $this->request = new JsonRequest(
            method: self::METHOD,
            headers: [
                self::HEADER_KEY => self::HEADER_VAL,
            ],
            uri: self::URI,
            data: self::DATA,
        );
    }

    public function testMethod(): void
    {
        self::assertSame(self::METHOD, $this->request->getMethod());
    }

    public function testUri(): void
    {
        self::assertSame(self::URI, (string) $this->request->getUri());
    }

    public function testJsonHeaders(): void
    {
        $header = 'application/json';
        self::assertSame($header, $this->request->getHeader('Accept')[0]);
        self::assertSame($header, $this->request->getHeader('Content-Type')[0]);
    }

    public function testAdditionalHeaders(): void
    {
        self::assertSame(
            self::HEADER_VAL,
            $this->request->getHeader(self::HEADER_KEY)[0]
        );
    }

    public function testBody(): void
    {
        $expectedBody = $this->encode(self::DATA);
        self::assertSame($expectedBody, (string) $this->request->getBody());
    }
}
