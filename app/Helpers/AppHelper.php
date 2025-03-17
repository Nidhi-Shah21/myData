<?php
if (!function_exists('app_env')) {
    /**
     * Helper to get the application environment.
     *
     * @return string
     */
    function app_env(): string
    {
        return config('app.env', 'production');
    }
}
if (!function_exists('app_url')) {
    /**
     * Helper to get the application URL.
     *
     * @return string
     */
    function app_url(): string
    {
        return config('app.url');
    }
}
if (!function_exists('app_locale')) {
    /**
     * Helper to get the application locale.
     *
     * @return string
     */
    function app_locale(): string
    {
        return config('app.locale', 'en');
    }
}
if (!function_exists('current_user')) {
    /**
     * Helper to get the currently authenticated user.
     *
     * @return \App\Models\User|null
     */
    function current_user()
    {
        return auth()->user();
    }
}

if (!function_exists('public_storage_path')) {
    /**
     * Helper to get the storage path for public files.
     *
     * @param string $path
     * @return string
     */
    function public_storage_path($path = ''): string
    {
        return storage_path('app/public/' . $path);
    }
}
if (!function_exists('public_storage_url')) {
    /**
     * Get the public URL of a file stored in the 'storage/app/public' directory.
     *
     * @param string $path
     * @return string
     */
    function public_storage_url(string $path): string
    {
        return asset('storage/' . $path);
    }
}
if (!function_exists('public_path_file')) {
    /**
     * Get the absolute path of a file inside the public directory.
     *
     * @param string $path
     * @return string
     */
    function public_path_file(string $path = ''): string
    {
        return public_path($path);
    }
}

if (!function_exists('current_route')) {
    /**
     * Get the current route name.
     * echo current_route()
     * @return string|null
     */
    function current_route(): ?string
    {
        return request()->route() ? request()->route()->getName() : null;
    }
}
if (!function_exists('current_user_id')) {
    /**
     * Helper to get the currently authenticated user's ID.
     * echo current_user_id(); // Output: 1 (if the user is logged in), null (if not logged in)
     * @return int|null
     */
    function current_user_id(): ?int
    {
        return auth()->id();
    }
}
if (!function_exists('is_admin')) {
    /**
     * Check if the authenticated user is an admin.
     * if (is_admin()) {
     *     echo "Welcome, Admin!";
     * }
     * @return bool
     */
    function is_admin(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }
}
//Get Client IP Address
if (!function_exists('client_ip')) {
    /**
     * Get the client's IP address.
     * echo client_ip(); // Output: 192.168.1.1 (or user's IP address)
     * @return string|null
     */
    function client_ip(): ?string
    {
        return request()->ip();
    }
}

