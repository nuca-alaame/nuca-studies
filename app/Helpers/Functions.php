<?php

use App\Models\AppInfo;
use Illuminate\Support\Facades\Cache;

if (! function_exists('appInfo')) {
    function appInfo($key, $default = null)
    {
        $appInfo = Cache::remember('appInfo.'.$key, 3600, function () use ($key) {
            return AppInfo::query()
                ->where('key', $key)
                ->first();
        });

        return $appInfo ? $appInfo->value : $default;
    }
}

if (! function_exists('errorLog')) {
    function errorLog(Throwable $exception): void
    {
        logger()->info($exception->getMessage());
        logger()->info($exception->getTraceAsString());
    }
}
