<?php

namespace App\Entity;

use App\Entity\Author;
use App\Entity\Domaine;
use App\Entity\Evaluation;
use App\Entity\CompanyLogo;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Link;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CompanyRepository;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\CompanyGetController;
use App\Filter\InvestCustomsSearchFilter;
use App\Controller\CreateCompanyController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['companyType.type' => 'exact', 'Domaine' => 'iexacte', 'companySize.size' => 'exact'])]
#[ApiResource(
    normalizationContext: [
        'groups' => ['company_read']
    ],
    operations: [
        new Get(),
        new GetCollection(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: CreateCompanyController::class,
            deserialize: false
        ),
    ]
)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['company_read']
    ],
    uriTemplate: '/users/{id}/companies', 
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            fromProperty: 'companies'
        )
    ], 
    operations: [new GetCollection()]
)]

class Company extends Author
{

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read','job_offers_read'])]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read','job_offers_read'])]
    private ?string $Adress = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read','job_offers_read'])]
    private ?string $Pays = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read','job_offers_read'])]
    private ?string $NifStat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['company_read', 'invest_read'])]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $numero = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $webSite = null;

    #[ORM\ManyToMany(targetEntity: Domaine::class, inversedBy: 'companies')]
    #[Groups(['company_read', 'invest_read','job_offers_read'])]
    private Collection $Domaine;

    #[ORM\OneToMany(mappedBy: 'Company', targetEntity: CompanyLogo::class, orphanRemoval: true)]
    #[Groups(['users_read', 'posts_read', 'image_read', 'company_read', 'invest_read'])]
    private Collection $companyLogo;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['users_read', 'posts_read','image_read','discu_read','msg_read','company_read','invest_read','job_offers_read'])]
    private ?CompanyLogo $activeLogo = null;

    #[ORM\ManyToOne(targetEntity: Author::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read', 'image_read', 'invest_read'])]
    private ?Author $author = null;

    #[ORM\ManyToOne(inversedBy: 'company')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['company_read', 'invest_read'])]
    private ?CompanySize $companySize = null;

    #[ORM\ManyToOne(inversedBy: 'company')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['company_read', 'invest_read'])]
    private ?CompanyType $companyType = null;

    // #[ORM\ManyToMany(targetEntity:Evaluation::class)]
    // #[ORM\JoinTable(name:"company_evaluation")]
    // #[ORM\JoinColumn(name:"company_id", referencedColumnName:"id")]
    // #[InverseJoinColumn(name:"evaluation_id", referencedColumnName:"id")]
    // private $evaluations;


    public function __construct()
    {
        $this->Domaine = new ArrayCollection();
        $this->companyLogo = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): static
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getNifStat(): ?string
    {
        return $this->NifStat;
    }

    public function setNifStat(string $NifStat): static
    {
        $this->NifStat = $NifStat;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(?string $webSite): static
    {
        $this->webSite = $webSite;

        return $this;
    }

    /**
     * @return Collection<int, Domaine>
     */
    public function getDomaine(): Collection
    {
        return $this->Domaine;
    }

    public function addDomaine(Domaine $domaine): static
    {
        if (!$this->Domaine->contains($domaine)) {
            $this->Domaine->add($domaine);
        }

        return $this;
    }

    public function removeDomaine(Domaine $domaine): static
    {
        $this->Domaine->removeElement($domaine);

        return $this;
    }

    /**
     * @return Collection<int, ComapnyLogo>
     */
    public function getCompanyLogo(): Collection
    {
        return $this->companyLogo;
    }

    public function addCompanyLogo(CompanyLogo $companyLogo): self
    {
        if (!$this->companyLogo->contains($companyLogo)) {
            $this->companyLogo[] = $companyLogo;
            $this->companyLogo->add($companyLogo);
        }

        return $this;
    }

    public function removeCompanyLogo(CompanyLogo $companyLogo): self
    {
        if ($this->companyLogo->contains($companyLogo)) {
            $this->companyLogo->removeElement($companyLogo);

            if ($companyLogo->getCompany() === $this) {
                $companyLogo->setCompany(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getCompanySize(): ?CompanySize
    {
        return $this->companySize;
    }

    public function setCompanySize(?CompanySize $companySize): static
    {
        $this->companySize = $companySize;

        return $this;
    }

    public function getCompanyType(): ?CompanyType
    {
        return $this->companyType;
    }

    public function setCompanyType(?CompanyType $companyType): static
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get the value of activeLogo
     */ 
    public function getActiveLogo()
    {
        return $this->activeLogo;
    }

    /**
     * Set the value of activeLogo
     *
     * @return  self
     */ 
    public function setActiveLogo($activeLogo)
    {
        $this->activeLogo = $activeLogo;

        return $this;
    }

    // /**
    //  * @return Collection|Evaluation[]
    //  */
    // public function getEvaluations(): Collection
    // {
    //     return $this->evaluations;
    // }

    // public function addEvaluation(Evaluation $evaluation): self
    // {
    //     if (!$this->evaluations->contains($evaluation)) {
    //         $this->evaluations[] = $evaluation;
    //     }

    //     return $this;
    // }

    // public function removeEvaluation(Evaluation $evaluation): self
    // {
    //     $this->evaluations->removeElement($evaluation);

    //     return $this;
    // }
}


































































































































































// created By Nyaina