<?php

//file
if (!function_exists('fileSizeInKB')) {
    /**
     * Convert bytes into KB.
     *
     * @param  int  $bytes
     * @return string
     */
    function fileSizeInKB($bytes)
    {
        return round($bytes / 1024, 2); // 1 KB = 1024 bytes
    }
}

if (!function_exists('fileSizeInMB')) {
    /**
     * Convert bytes into MB.
     *
     * @param  int  $bytes
     * @return string
     */
    function fileSizeInMB($bytes)
    {
        return round($bytes / (1024 * 1024), 2); // 1 MB = 1024 KB
    }
}

if (!function_exists('fileSizeInGB')) {
    /**
     * Convert bytes into GB.
     *
     * @param  int  $bytes
     * @return string
     */
    function fileSizeInGB($bytes)
    {
        return round($bytes / (1024 * 1024 * 1024), 2); // 1 GB = 1024 MB
    }
}

if (!function_exists('fileSizeInTB')) {
    /**
     * Convert bytes into TB.
     *
     * @param  int  $bytes
     * @return string
     */
    function fileSizeInTB($bytes)
    {
        return round($bytes / (1024 * 1024 * 1024 * 1024), 2); // 1 TB = 1024 GB
    }
}

if (!function_exists('fileSizeHumanReadable')) {
    /**
     * Convert bytes into a human-readable file size format.
     *
     * @param  int  $bytes
     * @return string
     */
    function fileSizeHumanReadable($bytes)
    {
        $sizeUnits = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($sizeUnits) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $sizeUnits[$i];
    }
}
