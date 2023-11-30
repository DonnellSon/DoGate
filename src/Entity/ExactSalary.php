<?php

// src/Entity/ExactSalary.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"exact_salaries")]
#[ApiResource]
class ExactSalary extends Salary
{
    #[ORM\Column(type:"integer")]
    private $amount;

    /**
     * Get the value of exactAmount
     */ 
    public function getExactAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of exactAmount
     *
     * @return  self
     */ 
    public function setExactAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }
}
