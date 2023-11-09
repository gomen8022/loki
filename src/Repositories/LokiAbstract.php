<?php

namespace Loki\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Loki\Helpers\ConfigLoaderTrait;

abstract class LokiAbstract
{
    use ConfigLoaderTrait;

    public function getClient(): Client
    {
        return new Client ([
            'base_uri' => $this->getConfig('app.loki_url'),
        ]);
    }

    public function createRequest(
        string $method,
        string $uri,
        array  $formParams = []
    ): Collection
    {
        try {
            $this->responce = $this->getClient()->request($method, $this->getConfig('app.loki_url') . $uri, [
                'form_params' => $formParams,
            ]);

            return collect(json_decode($this->responce->getBody()->getContents(), true));

        } catch (RequestException $exception) {
            Log::info($exception->getMessage());
            throw new \Exception($exception->getMessage());
        }
    }

    public function get(string $url, array $data = []): array
    {
        return $this->createRequest('GET', $url, $data)->all();
    }

    public function post(string $url, array $data): array
    {
        return $this->createRequest('POST', $url, $data)->all();
    }
}
