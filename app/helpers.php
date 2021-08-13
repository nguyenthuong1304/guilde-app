<?php

/**
 * Get logger
 */
if (!function_exists('getLogger')) {
    function getLogger()
    {
        return Log::channel(env('LOG_CHANNEL', 'daily'));
    }
}

/**
 * Log info
 */
if (!function_exists('logInfo')) {
    function logInfo($info)
    {
        getLogger()->info($info);
    }
}
