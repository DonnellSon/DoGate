<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\DomaineRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DomaineRepository::class)]
#[ApiResource()]
class Domaine
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['company_read','invest_read','job_offers_read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read','invest_read','job_offers_read'])]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Investissement::class, inversedBy: 'domaines')]
    #[ORM\JoinColumn(nullable:false, onDelete:"CASCADE")]
    private Collection $Invest;

    #[ORM\ManyToMany(targetEntity: Company::class, mappedBy: 'Domaine')]
    #[ORM\JoinColumn(nullable:false, onDelete:"CASCADE")]
    private Collection $companies;

    public function __construct()
    {
        $this->Invest = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Investissement>
     */
    public function getInvest(): Collection
    {
        return $this->Invest;
    }

    public function addInvest(Investissement $invest): static
    {
        if (!$this->Invest->contains($invest)) {
            $this->Invest->add($invest);
        }

        return $this;
    }

    public function removeInvest(Investissement $invest): static
    {
        $this->Invest->removeElement($invest);

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): static
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
            $company->addDomaine($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->companies->removeElement($company)) {
            $company->removeDomaine($this);
        }

        return $this;
    }

 

    
}
