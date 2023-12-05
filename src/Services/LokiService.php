<?php

namespace Loki\Services;

use Loki\DTO\RequestDataDTO;
use Loki\Helpers\ConfigLoaderTrait;
use Loki\Helpers\UuidDevice;
use Illuminate\Http\Response;
use Loki\Repositories\RestRepositoryInterface;
use Illuminate\Validation\Factory;
use Illuminate\Translation\Translator;
use Illuminate\Translation\ArrayLoader;

class LokiService
{
    use ConfigLoaderTrait;

    protected RestRepositoryInterface $restRepository;

    public function __construct(RestRepositoryInterface $restRepository)
    {
        $this->restRepository = $restRepository;
    }

    //TODO: test at back side
    public function postStats(
        array $request
    )
    {
        try {
            $requestData = new RequestDataDTO($request);
        } catch (\InvalidArgumentException $e) {
            throw new \Exception('RequestDataDTO validation failed: ' . $e->getMessage());
        }

        try {
            $this->restRepository->postFlip($requestData->toArray());
        } catch (\Throwable $e) {
            throw new \Exception('restRepository postFlip failed: ' . $e->getMessage());
        }

        return new Response("", 204);
    }

    public function postUnliquidStats(
        array $request
    ): Response
    {
        try {
            $requestData = new RequestDataDTO($request);
        } catch (\InvalidArgumentException $e) {
            throw new \Exception('RequestDataDTO validation failed: ' . $e->getMessage());
        }

        $data = $requestData->toJson();

        $file = $this->getConfig('app.session_stored');

        if (!file_exists('data')) {
            mkdir('data');
        }

        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }

        $fileData = json_decode(file_get_contents($file), true);
        $fileData[] = $data;
        file_put_contents($file, json_encode($fileData));

        return new Response("", 204);
    }

    public function getFlipBlocks(
        array $request
    )
    {
        $translator = new Translator(new ArrayLoader(), 'en');
        $factory = new Factory($translator);

        $validator = $factory->make($request, [
            'uri' => 'required',
            'ip' => 'required',
            'user_agent' => 'required',
            'blocks' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new \Exception('getFlipBlocks validation failed');
        }
        $uuid = (new UuidDevice())->get();

        $blocks = [
            'blocks' => $request['blocks'],
            'ip' => $request['ip'],
            'slash' => $request['uri'],
            'user_id' => $uuid,
            'user_agent' => $request['user_agent'],
        ];

        $flips = $this->restRepository->getFlips($blocks);

        foreach ($flips['blocks'] as $key => $flip) {
            if (strpos($key, 'conv_') !== false && in_array($flip['vertical'], [0, 1])) {
                unset($flips['blocks'][$key]);
            }
        }

        return [
            'turn' => $this->orderList($flips['blocks']),
            'uuid' => $uuid
        ];
    }

    public function orderList(array $array): array
    {
        $ordered = [];

        array_multisort(array_column($array, 'vertical'), SORT_ASC, $array);

        foreach ($array as $key => $value) {
            $ordered[$key] = $value['horizontal'];
        }

        return $ordered;
    }

    public function sendStatistics()
    {
        $filename = $this->getConfig('app.session_stored');
        if (!file_exists($filename)) {
            throw new \Exception('sendStatistics No session data');
        }
        $data = json_decode(file_get_contents($filename));
        if (count($data) > 0) {
            $dataChunk = array_chunk($data, 50);
            foreach ($dataChunk as $item) {
                try {
                    $this->restRepository->postUnliquidStats(['data' => $item]);
                } catch (\Throwable $e) {
                    throw new \Exception('sendStatistics ' . $e->getMessage());
                }
            }
            file_put_contents($filename, json_encode([]));
        }

        return new Response("", 204);
    }

}
