<?php

use Usmanzahid\ServiceResponse\ServiceResponse;

if (!function_exists('success')) {
    function success(mixed $data = null, string $message = 'Success!'): ServiceResponse {
        return (new ServiceResponse())->withMessage($message)
            ->withData($data);
    }
}

if (!function_exists('fail')) {
    function fail(array $errors = [], string $message = 'Failed!'): ServiceResponse {
        return (new ServiceResponse())->withMessage($message)
            ->withSuccess(false)
            ->withErrors($errors);
    }
}
