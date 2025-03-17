<?php
use Illuminate\Http\JsonResponse;
if (!function_exists('successResponse')) {
    /**
     * Return a success JSON response.
     *
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    function successResponse(string $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ], 200);
    }
}

if (!function_exists('errorResponse')) {
    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $status
     * @param array $errors
     * @return JsonResponse
     */
    function errorResponse(string $message, int $status = 400, array $errors = []): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}

if (!function_exists('notFoundResponse')) {
    /**
     * Return a 404 JSON response.
     *
     * @param string $message
     * @return JsonResponse
     */
    function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return response()->json([
            'status' => 404,
            'message' => $message,
        ], 404);
    }
}

if (!function_exists('unauthorizedResponse')) {
    /**
     * Return an unauthorized JSON response.
     *
     * @param string $message
     * @return JsonResponse
     */
    function unauthorizedResponse(string $message = 'Unauthorized access'): JsonResponse
    {
        return response()->json([
            'status' => 401,
            'message' => $message,
        ], 401);
    }
}

if (!function_exists('validationErrorResponse')) {
    /**
     * Return a validation error JSON response.
     *
     * @param array $errors
     * @param string $message
     * @return JsonResponse
     */
    function validationErrorResponse(array $errors, string $message = 'Validation failed'): JsonResponse
    {
        return response()->json([
            'status' => 422,
            'message' => $message,
            'errors' => $errors,
        ], 422);
    }
}
