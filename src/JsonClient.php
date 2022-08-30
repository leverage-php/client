<?php

declare(strict_types=1);

namespace Leverage\Client;

use GuzzleHttp\Client;
use Leverage\Encoder\JsonEncoder;
use Psr\Http\Message\RequestInterface;

class JsonClient
{
    public function __construct(
        private readonly Client $client = new Client,
        private readonly JsonEncoder $json = new JsonEncoder,
    ) {
    }

    public function send(
        RequestInterface $request,
    ): JsonResponse {
        $response = $this->client->send($request);

        $body = (string) $response->getBody();

        if (!$body) {
            return new JsonResponse($response);
        }

        $data = $this->json->decode($body);

        return new JsonResponse($response, $data);
    }
}
