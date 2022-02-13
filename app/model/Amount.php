<?php

namespace App\Model;

use App\Model;

class Amount extends Model
{
    private $value = 0;

    public function __construct($value)
    {
        $this->value = $value;
    }


    public function add(Amount $value) : self
    {
        return new Amount((float)$this->value + (float) $value->getValue());
    }


    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

}
