<?php

namespace App\Model\Entity\Exception;

class PropertyNonExistsException extends \Exception
{
    public function __construct($property)
    {
        parent::__construct(sprintf("Property %s non exists in data.", $property));
    }
}
