<?php

declare(strict_types=1);

namespace Leverage\Client;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class JsonResponse implements ResponseInterface
{
    public function __construct(
        private readonly ResponseInterface $response,
        private readonly ?array $data = null,
    ) {
    }

    #region MessageInterface
    public function getProtocolVersion()
    {
        return $this->response->getProtocolVersion();
    }

    public function withProtocolVersion($version)
    {
        return new static(
            $this->response->withProtocolVersion($version),
            $this->data,
        );
    }

    public function getHeaders()
    {
        return $this->response->getHeaders();
    }

    public function hasHeader($name)
    {
        return $this->response->hasHeader($name);
    }

    public function getHeader($name)
    {
        return $this->response->getHeader($name);
    }

    public function getHeaderLine($name)
    {
        return $this->response->getHeaderLine($name);
    }

    public function withHeader($name, $value)
    {
        return new static(
            $this->response->withHeader($name, $value),
            $this->data,
        );
    }

    public function withAddedHeader($name, $value)
    {
        return new static(
            $this->response->withAddedHeader($name, $value),
            $this->data,
        );
    }

    public function withoutHeader($name)
    {
        return new static(
            $this->response->withoutHeader($name),
            $this->data,
        );
    }

    public function getBody()
    {
        return $this->response->getBody();
    }

    public function withBody(
        StreamInterface $body,
    ) {
        $this->response->withBody($body);
        return $this;
    }
    #endregion

    #region ResponseInterface
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    public function getReasonPhrase()
    {
        return $this->response->getReasonPhrase();
    }

    public function withStatus(
        $code,
        $reasonPhrase = '',
    ): self {
        return new static(
            $this->response->withStatus($code, $reasonPhrase),
            $this->data,
        );
    }
    #endregion

    public function getData(): ?array
    {
        return $this->data;
    }
}
