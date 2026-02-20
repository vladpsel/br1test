<?php

namespace App\Validation;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class UniqueLogin extends Constraint
{
    public string $message = 'Логін "{{ value }}" вже зайнятий';
}
