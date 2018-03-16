<?php

namespace App\Model\Entity\Exception;

class BadValueException extends \Exception
{
    public function __construct($property)
    {
        parent::__construct(sprintf("Bad property value of %s.", $property));
    }
}
