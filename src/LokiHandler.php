<?php

namespace Loki;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Loki\Services\LokiService;
use Loki\Repositories\LokiFormingRepository;
use Loki\Repositories\LokiStatRepository;


class LokiHandler
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = self::getInstance();
        if (method_exists($instance, $name)) {
            return call_user_func_array([$instance, $name], $arguments);
        } else {
            throw new \Exception("method $name do not exist");
        }
    }

    protected function getPageBlocks($params): array
    {
        $formingRepo = new LokiFormingRepository();
        $loki = new LokiService($formingRepo);
        return $loki->getFlipBlocks($params);
    }

    protected function sendStatistic(): Response
    {
        $formingRepo = new LokiStatRepository();
        $loki = new LokiService($formingRepo);

        return $loki->sendStatistics();
    }

    protected function postStatistic($params): Response
    {
        $formingRepo = new LokiStatRepository();
        $loki = new LokiService($formingRepo);
        return $loki->postStats($params);
    }

    protected function postAnalyticStatistic($params): Response
    {
        $formingRepo = new LokiStatRepository();
        $loki = new LokiService($formingRepo);
        return $loki->postUnliquidStats($params);
    }

}
