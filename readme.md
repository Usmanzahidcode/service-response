# Service Response

A minimal and structured way to handle internal service communication in PHP applications.

Instead of returning `null`, `false`, or loosely structured arrays, `ServiceResponse` provides a consistent object with success status, message, data, errors, and optional meta information.

This makes debugging, error handling, and chaining service calls much clearer and more maintainable.

### Includes:

- A core `ServiceResponse` class with fluent, chainable methods
- Optional meta support
- Previous response chaining
- A consistent structure for both success and failure cases

### Helper Functions

This package also includes safe, global helper functions:

- `service_response_success($data = null, $message = 'Success!', $meta = [])`
- `service_response_fail($errors = [], $message = 'Failed!', $data = null, $meta = [])`
- `service_response_from_exception(Throwable $e, ?string $message = null, bool $includeTrace = false, array $meta = [])`

These can be used anywhere to create standardized responses easily, without directly instantiating the class.