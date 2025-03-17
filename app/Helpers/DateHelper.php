<?php

//date and time
if (!function_exists('formatDateTime')) {
    /**
     * Format a given date to 'Y-m-d H:i:s' in Australia/Melbourne timezone.
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatDateTime($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('Y-m-d H:i:s');
    }
}

if (!function_exists('formatDate')) {
    /**
     * Format a given date to 'd/m/Y' (e.g., 25/12/2025).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatDate($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('d/m/Y');
    }
}

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
        return $date->format('h:i A');
    }
}

if (!function_exists('formatDateWithDay')) {
    /**
     * Format a given date to 'l, d F Y' (e.g., Friday, 25 December 2025).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatDateWithDay($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('l, d F Y');
    }
}

if (!function_exists('formatShortDate')) {
    /**
     * Format a given date to 'd M Y' (e.g., 25 Dec 2025).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatShortDate($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format('d M Y');
    }
}

if (!function_exists('formatISODateTime')) {
    /**
     * Format a given date to ISO 8601 (e.g., 2025-12-25T15:30:00+11:00).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatISODateTime($date): string
    {
        $date = new DateTime($date, new DateTimeZone('Australia/Melbourne'));
        return $date->format(DATE_ATOM);
    }
}

if (!function_exists('formatHumanReadable')) {
    /**
     * Format a given date to a human-readable format (e.g., 2 days ago, 1 hour ago).
     *
     * @param string|DateTime $date
     * @return string
     */
    function formatHumanReadable($date): string
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
