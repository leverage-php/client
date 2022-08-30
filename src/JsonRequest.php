<?php

declare(strict_types=1);

namespace Leverage\Client;

use GuzzleHttp\Psr7\Request;
use JsonSerializable;
use Leverage\Encoder\JsonTrait;
use Psr\Http\Message\UriInterface;

class JsonRequest extends Request
{
    use JsonTrait;

    /**
     * @param array<string, string|string[]> $headers Request headers
     */
    public function __construct(
        string $method,
        string | UriInterface $uri,
        array $headers = [],
        array | JsonSerializable $data = [],
        string $version = '1.1',
    ) {
        parent::__construct(
            method: $method,
            uri: $uri,
            headers: array_merge($headers, [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]),
            body: $this->encode($data),
            version: $version,
        );
    }
}
