<?php

namespace Loki\DTO;

use Carbon\Carbon;
use Illuminate\Translation\Translator;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Validation\Factory;

class RequestDataDTO
{
    public string $city;
    public string $country;
    public array $data;
    public string $userAgent;
    public string $uri;
    public string $ip;
    public string $domain;

    public function __construct(array $data)
    {
        $this->validate($data);

        $this->setCity($data['city']);
        $this->setCountry($data['country']);
        $this->setData($data['data']);
        $this->setUserAgent($data['user_agent']);
        $this->setUri($data['uri']);
        $this->setIp($data['ip']);
        $this->setDomain($data['domain']);
    }

    protected function validate(array $data)
    {
        $translator = new Translator(new ArrayLoader(), 'en');
        $factory = new Factory($translator);

        $validator = $factory->make($data, [
            'city' => 'required',
            'country' => 'required',
            'data' => 'array|required',
            'user_agent' => 'required',
            'uri' => 'required',
            'ip' => 'required',
            'domain' => 'required',
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    // Getters
    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    // Setters
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function getFormingType()
    {
        return $this->data['forming_type'];
    }

    public function getLead()
    {
        return $this->data['lead'] ?? false;
    }

    public function getUserId()
    {
        return $this->data['user_id'];
    }

    public function toJson(): string
    {
        $data = [
            'user_id' => $this->getUserId(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'data' => $this->getData(),
            'user_agent' => $this->getUserAgent(),
            'uri' => $this->getUri(),
            'ip' => $this->getIp(),
            'domain' => $this->getDomain(),
            'forming_type' => $this->getFormingType(),
            'lead' => $this->getLead()
        ];

        $data['data'] = json_encode($data['data']);

        return json_encode($data);
    }

    public function toArray(): array
    {
        $data = [
            'user_id' => $this->getUserId(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'data' => $this->getData(),
            'user_agent' => $this->getUserAgent(),
            'uri' => $this->getUri(),
            'ip' => $this->getIp(),
            'domain' => $this->getDomain(),
            'forming_type' => $this->getFormingType(),
            'lead' => $this->getLead(),
            'time' => Carbon::now()->toDateTimeString(),
        ];

        $data['data'] = json_encode($data['data']);

        return $data;
    }
}