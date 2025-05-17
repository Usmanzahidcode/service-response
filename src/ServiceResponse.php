<?php

namespace UsmanZahid\ServiceResponse;


class ServiceResponse {
    private ?string $message = null;
    private bool $success = true;
    private mixed $data = null;
    private array $errors = [];
    private ?self $previous = null;

    public function withMessage(string $message): self {
        $this->message = $message;
        return $this;
    }

    public function withSuccess(bool $success): self {
        $this->success = $success;
        return $this;
    }

    public function withError(string $key, string $message): self {
        $this->errors[$key][] = $message;
        return $this;
    }

    public function withErrors(array $errors): self {
        foreach ($errors as $key => $messages) {
            foreach ((array) $messages as $message) {
                $this->withError($key, $message);
            }
        }
        return $this;
    }

    public function withData(mixed $data): self {
        $this->data = $data;
        return $this;
    }

    public function withPrevious(self $previous): self {
        $this->previous = $previous;
        return $this;
    }

    public function getMessage(): ?string {
        return $this->message;
    }

    public function wasSuccessful(): bool {
        return $this->success===true;
    }

    public function wasNotSuccessful(): bool {
        return !$this->wasSuccessful();
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function getAllErrors(): array {
        $all = $this->errors;
        $prev = $this->previous;
        while ($prev) {
            $all = array_merge_recursive($prev->getErrors(), $all);
            $prev = $prev->previous;
        }
        return $all;
    }

    public function getData(): mixed {
        return $this->data;
    }

    public function getRootCause(): self {
        $origin = $this;
        while ($origin->previous!==null) {
            $origin = $origin->previous;
        }
        return $origin;
    }

    public function toArray(): array {
        return [
            'success' => $this->wasSuccessful(),
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->getAllErrors(),
        ];
    }
}
