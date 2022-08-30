# Leverage HTTP Clients

Clients for common HTTP scenarios.

The first/only/best example being a JSON client that assumes JSON in the request
payload and in the response body.

PSR compliant with headers set automatically.

## Usage

```
use Leverage\Client\JsonClient;
use Leverage\Client\JsonRequest;
use Leverage\Client\JsonResponse;

$request = new JsonRequest(
    method: 'GET',
    uri: 'https://example.com',
    data: [
        'key' => 'val',
    ],
);
$client = new JsonClient;
$response = $client->send($request);
```

## Dev

This repo assumes you have a suitable version of Docker available.

Copy `.env.dist` to `.env`.  It's very unlikely you'll need to update these values.

Run `./bin/composer install`.

The standard Leverage Toolchain scripts are available in `./vendor/bin/`.

Make sure to run `./vendor/bin/verify` before you push.
