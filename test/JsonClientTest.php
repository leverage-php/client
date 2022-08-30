<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Leverage\Client\JsonClient;
use Leverage\Client\JsonRequest;
use Leverage\Encoder\JsonEncoder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JsonClientTest extends TestCase
{
    private JsonClient $client;

    private MockObject & Client $delegate;
    private MockObject & JsonEncoder $json;
    private MockObject & RequestInterface $request;
    private MockObject & ResponseInterface $response;

    public function setUp(): void
    {
        $this->mockDelegate();
        $this->json = self::createMock(JsonEncoder::class);
        $this->request = self::createMock(JsonRequest::class);
        $this->client = new JsonClient(
            client: $this->delegate,
            json: $this->json,
        );
    }

    public function testEmptyBodyIsNullData(): void
    {
        $this->response->method('getBody')->willReturn('');

        $response = $this->client->send($this->request);

        self::assertNull($response->getData());
    }

    public function testSend(): void
    {
        $data = [
            'key' => 'val',
        ];

        // this mocks returning a valid body but we're going to mock the decode
        // anyway so no need to load up real yet fake data.
        $this->response->method('getBody')->willReturn(true);
        $this->json->method('decode')->willReturn($data);

        $response = $this->client->send($this->request);

        self::assertSame($data, $response->getData());
    }

    private function mockDelegate(): void
    {
        $this->response = self::createMock(ResponseInterface::class);
        $this->delegate = self::createMock(Client::class);

        $this->delegate->method('send')->willReturn($this->response);
    }
}
