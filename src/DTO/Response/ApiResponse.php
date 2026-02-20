<?php

declare(strict_types=1);

namespace App\DTO\Response;

class ApiResponse
{
    public function __construct(
        private mixed $data,
        private string $message = 'Success',
        private int $code = 200,
    ) {}

    public function toArray(): array
    {
        return [
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data,
        ];
    }
}
