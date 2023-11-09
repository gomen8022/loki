<?php

namespace Loki\Repositories;

use Loki\Helpers\CacheHelper;

class LokiStatRepository extends LokiAbstract implements RestRepositoryInterface
{
    use CacheHelper;

    public function postFlip(array $data): array
    {
        return $this->post('flipcore/statistics', $data);
    }

    public function postUnliquidStats(array $data): array
    {
        return $this->post('flipcore/post-unliquid-statistics', $data);
    }
}