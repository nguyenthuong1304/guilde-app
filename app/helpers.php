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

/**
 * Log info
 */
if (!function_exists('replaceImage')) {
    function replaceImage(string $image)
    {
        return substr_replace($image, '', 0, strpos($image, '/post/') + 1);
    }
}
