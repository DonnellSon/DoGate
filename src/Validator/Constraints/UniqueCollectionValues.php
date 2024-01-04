<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Attribute;

#[Attribute]
class UniqueCollectionValues extends Constraint
{
    public $message = 'Les valeurs doivent être uniques.';
}

class UniqueCollectionValuesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value) {
            return;
        }

        if (!is_array($value) && !$value instanceof \Traversable) {
            throw new UnexpectedTypeException($value, 'array or Traversable');
        }

        if (count($value) !== count(array_unique($value))) {
            $this->context->buildViolation($constraint->message)->addViolation();
         }
    }
}