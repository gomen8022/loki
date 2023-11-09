<?php
namespace Loki\Repositories;

use Loki\Helpers\CacheHelper;

class LokiFormingRepository extends LokiAbstract implements RestRepositoryInterface
{
    use CacheHelper;

    public function getFlips(array $data): array
    {
        return $this->post('flipcore/flips', $data);
    }
}
