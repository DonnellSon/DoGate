<?php

// src/Entity/Salary.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\ExactSalary;
use App\Entity\RangeSalary;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name:"salaries")]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap(["rangeSalary" => RangeSalary::class, "exactSalary" => ExactSalary::class])]
#[ApiResource]
class Salary
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"AUTO")]
    #[ORM\Column(type:"integer")]
    #[Groups(['users_read','job_offers_read'])]
    private $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['users_read','job_offers_read'])]
    private ?Currency $currency = null;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): static
    {
        $this->currency = $currency;

        return $this;
    }
}
