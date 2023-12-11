<?php

// src/Entity/RangeSalary.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name:"range_salaries")]
#[ApiResource]
class RangeSalary extends Salary
{
    #[ORM\Column(type:"integer")]
    #[Groups(['users_read','job_offers_read'])]
    private $min;

    #[ORM\Column(type:"integer")]
    #[Groups(['users_read','job_offers_read'])]
    private $max;

    /**
     * Get the value of minRange
     */ 
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set the value of min
     *
     * @return  self
     */ 
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get the value of maxRange
     */ 
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set the value of max
     *
     * @return  self
     */ 
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }
}
