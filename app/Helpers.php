<?php

use Carbon\Carbon;

if (!function_exists('dateFormat')) {
    /**
     * Format date to a human-readable format.
     *
     * @param string|null $date
     * @param string $format
     * @return string
     */
    function dateFormat($date, $format = 'd M Y')
    {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('classStatus')) {
    /**
     * Generate a badge based on status.
     *
     * @param string $status
     * @return string
     */
    function classStatus($status)
    {
        $class = [
            'published' => 'text-green-800 bg-green-100',
            'draft' => 'text-gray-800 bg-gray-100',
            'schedule' => 'text-yellow-800 bg-yellow-100',
        ];

        return $class[$status];
    }
}
