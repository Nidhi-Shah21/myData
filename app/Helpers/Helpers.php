<?php
use Illuminate\Support\Facades\Log;
if (!function_exists('formatCurrency')) {
    function formatCurrency($amount)
    {
        return '$' . number_format($amount, 2);
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10)
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
    }
}

//  Format a Number as Currency (AUD)
if (!function_exists('format_aud_currency')) {
    /** echo format_aud_currency(528714.19);
     * Format a number as Australian currency.
     *
     * @param float $amount
     * @return string
     */
    function format_aud_currency(float $amount): string
    {
        return '$' . number_format($amount, 2);
    }
}
//extension check

if (!function_exists('extension_check')) {
    function extension_check($extension): string
    {
        $extension = strtoupper($extension);

        $imageExtensions = ['JPG', 'JPEG', 'GIF', 'PNG', 'HEIC', 'SVG', 'WEBP'];
        $pdfExtensions = ['PDF'];
        $audioExtensions = ['MP3', 'WAV'];
        $videoExtensions = ['MP4', 'AVI', 'MOV', 'WMV', 'MKV'];
        $excelExtensions = ['XLS', 'XLSX'];
        $wordExtensions = ['DOC', 'DOCX'];
        $csvExtensions = ['CSV'];
        $powerpointExtensions = ['PPT', 'PPTX'];
        $textExtensions = ['TXT'];
        $zipExtensions = ['ZIP', 'RAR', '7Z'];

        if (in_array($extension, $imageExtensions)) {
            return Attachment::IMAGE;
        }

        if (in_array($extension, $pdfExtensions)) {
            return Attachment::PDF;
        }

        if (in_array($extension, $audioExtensions)) {
            return Attachment::AUDIO;
        }

        if (in_array($extension, $videoExtensions)) {
            return Attachment::VIDEO;
        }

        if (in_array($extension, $excelExtensions)) {
            return Attachment::EXCEL;
        }

        if (in_array($extension, $wordExtensions)) {
            return Attachment::DOC;
        }

        if (in_array($extension, $csvExtensions)) {
            return Attachment::CSV;
        }

        if (in_array($extension, $powerpointExtensions)) {
            return Attachment::PPT;
        }

        if (in_array($extension, $textExtensions)) {
            return Attachment::TEXT;
        }

        if (in_array($extension, $zipExtensions)) {
            return Attachment::ARCHIVE;
        }

        return 'unknown';
    }
}

// log
//writeLog('info', 'User logged in', ['user_id' => auth()->id()]);
//writeLog('error', 'Something went wrong', ['exception' => $e->getMessage()]);
if (!function_exists('writeLog')) {
    function writeLog(string $level, string $message, array $context = []): void
    {
        $allowedLevels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];

        if (!in_array($level, $allowedLevels)) {
            $level = 'info';
        }

        Log::$level($message, $context);
    }
}
