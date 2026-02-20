<?php

namespace App\DTO\Request;

interface RequestContract
{

    public static function fromArray(array $data): static;
}
