<?php

namespace App\DTO;

interface RequestContract
{

    public static function fromArray(array $data): static;
}
