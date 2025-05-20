<?php

use Usmanzahid\ServiceResponse\ServiceResponse;

if (!function_exists('service_response_success')) {
    function service_response_success(
        mixed  $data = null,
        string $message = 'Success!'
    ): ServiceResponse {
        return (new ServiceResponse())
            ->withSuccess(true)
            ->withMessage($message)
            ->withData($data);
    }
}

if (!function_exists('service_response_fail')) {
    function service_response_fail(
        array  $errors = [],
        string $message = 'Failed!',
        mixed  $data = null
    ): ServiceResponse {
        return (new ServiceResponse())
            ->withSuccess(false)
            ->withMessage($message)
            ->withErrors($errors)
            ->withData($data);
    }
}

if (!function_exists('service_response_from_exception')) {
    function service_response_from_exception(
        Throwable $e
    ): ServiceResponse {
        return service_response_fail(
            ['exception' => [$e->getMessage()]],
            $e->getCode(),
        );
    }
}
