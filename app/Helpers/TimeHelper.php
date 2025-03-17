<?php
//time

if (!function_exists('formatTime')) {
    /**
     * Format a given date/time to 'H:i A' (e.g., 03:45 PM).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatTime($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('h:i A'); // 12-hour format with AM/PM
    }
}

if (!function_exists('formatTime24Hour')) {
    /**
     * Format a given date/time to 'H:i' (e.g., 15:45 for 24-hour format).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatTime24Hour($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('H:i'); // 24-hour format
    }
}

if (!function_exists('formatTimeWithSeconds')) {
    /**
     * Format a given date/time to 'H:i:s A' (e.g., 03:45:30 PM).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatTimeWithSeconds($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('h:i:s A'); // 12-hour format with seconds
    }
}

if (!function_exists('formatTimeAgo')) {
    /**
     * Format a given date/time to a relative time string (e.g., '2 hours ago').
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatTimeAgo($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        $now = new DateTime('now', new DateTimeZone('Australia/Melbourne'));
        $diff = $now->diff($date);

        if ($diff->y > 0)
            return $diff->y . ' year(s) ago';
        if ($diff->m > 0)
            return $diff->m . ' month(s) ago';
        if ($diff->d > 0)
            return $diff->d . ' day(s) ago';
        if ($diff->h > 0)
            return $diff->h . ' hour(s) ago';
        if ($diff->i > 0)
            return $diff->i . ' minute(s) ago';
        return 'Just now';
    }
}
