<?php
use Illuminate\Support\Str;
//Generate a Slug from a String
if (!function_exists('generate_slug')) {
    /**
     * Generate a URL-friendly slug from a string.
     * echo generate_slug('Hello World!'); // Output: hello-world
     * @param string $string
     * @return string
     */
    function generate_slug(string $string): string
    {
        return Str::slug($string, '-');
    }
}
//Convert a String to Title Case
if (!function_exists('title_case')) {
    /**
     * Convert a string to title case.
     * echo title_case('hello world'); // Output: Hello World
     * @param string $string
     * @return string
     */
    function title_case(string $string): string
    {
        return Str::title($string);
    }
}
//Check if a String is JSON
if (!function_exists('is_json')) {
    /**
     * Check if a string is a valid JSON format.
     * echo is_json('{"name": "John"}'); // Output: true
     * echo is_json('Hello World'); // Output: false
     * @param string $string
     * @return bool
     */
    function is_json(string $string): bool
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}
// Generate Random String
if (!function_exists('random_string')) {
    /**
     * Generate a random string of a given length.
     * echo random_string(); // Output: A random 16-character string
     * echo random_string(10); // Output: A random 10-character string
     * @param int $length
     * @return string
     */
    function random_string(int $length = 16): string
    {
        return Str::random($length);
    }
}
//Convert String to Snake Case
if (!function_exists('to_snake_case')) {
    /**
     * Convert a given string to snake_case.
     * echo to_snake_case('Hello World'); // Output: hello_world
     * @param string $string
     * @return string
     */
    function to_snake_case(string $string): string
    {
        return Str::snake($string);
    }
}
//Convert String to Camel Case
if (!function_exists('to_camel_case')) {
    /**
     * Convert a given string to camelCase.
     *
     * @param string $string
     * @return string
     */
    function to_camel_case(string $string): string
    {
        return Str::camel($string);
    }
}
//Limit String Length
if (!function_exists('limit_string')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param string $string
     * @param int $limit
     * @param string $end
     * @return string
     * echo limit_string('This is a very long sentence that needs to be shortened.', 20);
     */
    function limit_string(string $string, int $limit = 100, string $end = '...'): string
    {
        return Str::limit($string, $limit, $end);
    }
}
//Extract Numbers from a String
if (!function_exists('extract_numbers')) {
    /**
     * Extract numbers from a given string.
     * echo extract_numbers('Price: $1,234.56');
     * @param string $string
     * @return string
     */
    function extract_numbers(string $string): string
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
}
