<?php


namespace LJJackson\Volt\Exceptions;


use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use Throwable;

class PaymentValidationException extends InvalidArgumentException
{
    private array $errors;
    private int $statusCode;

    public function __construct(array $errors, int $statusCode = 400)
    {
        $this->errors = $errors;
        $this->statusCode = $statusCode;
        parent::__construct($this->getExceptionMessage());
    }

    private function getExceptionMessage(): string
    {
        $errors = array_map(fn ($error) => "[{$error['property']}] - {$error['message']}", $this->errors);

        return 'Invalid properties: ' . implode(', ', $errors);
    }
}