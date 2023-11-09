<?php

namespace Loki\Repositories;

interface RestRepositoryInterface
{
    function getClient();
    function createRequest(string $method,string $uri, array  $formParams);
    public function get(string $url, array $data);
    public function post(string $url, array $data);
}