<?php

declare(strict_types=1);

namespace App\Helpers;

use App\DTO\Request\RequestContract;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationHelper
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(Request $request, RequestContract $dtoClass): object
    {
        $data = json_decode($request->getContent(), true) ?? [];

        $dto = $dtoClass::fromArray($data);

        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()] = $error->getMessage();
            }

            $errString = implode(", \r\n", $messages);
            throw new UnprocessableEntityHttpException($errString);
        }

        return $dto;
    }
}
