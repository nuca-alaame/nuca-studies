<?php

if (! function_exists('errorLog')) {
    function errorLog(Throwable $exception): void
    {
        logger()->info($exception->getMessage());
        logger()->info($exception->getTraceAsString());
    }
}
