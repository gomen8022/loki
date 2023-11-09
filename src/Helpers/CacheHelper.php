<?php
namespace Loki\Helpers;

use Illuminate\Support\Facades\Cache;

trait CacheHelper {
    protected static int $SECONDS = 604800; // 1 week

    public function setCache(string $key, array $value): void
    {
        Cache::add($key, $value, static::$SECONDS);
    }

    public function getCache(string $key): ?array
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return null;
    }
}
