<?php

namespace App\Entity;

use App\Entity\Company;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use App\Filter\FilterByAuthor;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use App\Filter\CompanySizeFilter;
use Symfony\Flex\Path as FlexPath;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\InvestRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Filter\CompanySizeTitleFilter;
use App\Filter\CompanyTypeTitleFilter;
use Symfony\Component\Filesystem\Path;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\InvestGetController;
use App\Filter\InvestCustomsSearchFilter;
use App\Controller\CreateInvestController;
use App\Controller\SearchInvestController;
use Doctrine\Common\Collections\Collection;
use App\Controller\GetInvestmentsController;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppAssert;

#[ORM\Entity(repositoryClass: InvestRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: [
        'groups' => ['invest_read']
    ],
    operations: [
        new GetCollection(),
        new Get(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: CreateInvestController::class,
            deserialize: false
        ),
    ]
)]
#[ApiFilter(CompanyTypeTitleFilter::class,properties:['companyTypeTitles'=>'exact'])]
#[ApiFilter(CompanySizeFilter::class,properties:['companySizes'=>'exact'])]
#[ApiFilter(FilterByAuthor::class,properties:['or'])]
#[ApiFilter(SearchFilter::class, properties: ["title" => "exact", 
"description" => "partial",
"need" => "partial",
"domaine.title" => "partial",
"author.companies.name" => "exact",
"author.pays" => "partial",
"author.companytypes.type" => "exact",
"collected" => "partial"])]
class Invest
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read', 'invest_read'])]
    #[Assert\NotBlank(message:'Le titre est obligatoire !')]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'La déscription est obligatoire !')]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $description = null;


    #[ORM\ManyToMany(targetEntity: Domain::class, mappedBy: 'invest')]
    #[ORM\JoinColumn(name: "domain-invest")]
    #[Groups(['company_read', 'invest_read'])]
    #[Assert\NotNull(message:'Vous devez specifier au moins un domaine !')]
    #[Assert\Count([
        'min'=>'1',
        'minMessage'=>'Vous devez specifier au moins un domaine !'
    ])]
    private ?Collection $domains;

    #[ORM\ManyToOne(targetEntity: Author::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read', 'image_read', 'invest_read'])]
    #[Assert\NotBlank(message:'Vous devez specifier un auteur !')]
    private ?Author $author = null;

    #[ORM\OneToMany(mappedBy: 'invest', targetEntity: InvestPicture::class)]
    #[Groups(['image_read', 'invest_read'])]
    private Collection $investPictures;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:"Le besoin doit etre composé d'un montant et d'une devise !")]
    private ?Amount $need = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Amount $collected = null;


    public function __construct()
    {
        $this->domains = new ArrayCollection();
        $this->investPictures = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @return Collection<int, Domain>
     */
    public function getDomains(): ?Collection
    {
        return $this->domains;
    }

    public function addDomain(Domain $domain): static
    {
        if (!$this->domains->contains($domain)) {
            $this->domains->add($domain);
            $domain->addInvest($this);
        }

        return $this;
    }

    public function removeDomain(Domain $domain): static
    {
        if ($this->domains->removeElement($domain)) {
            $domain->removeInvest($this);
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

    /**
     * @return Collection<int, InvestPicture>
     */
    public function getInvestPictures(): Collection
    {
        return $this->investPictures;
    }

    public function addInvestPicture(InvestPicture $investPicture): static
    {
        if (!$this->investPictures->contains($investPicture)) {
            $this->investPictures->add($investPicture);
            $investPicture->setInvest($this);
        }

        return $this;
    }

    public function removeInvestPicture(InvestPicture $investPicture): static
    {
        if ($this->investPictures->removeElement($investPicture)) {
            if ($investPicture->getInvest() === $this) {
                $investPicture->setInvest(null);
            }
        }

        return $this;
    }

    public function getNeed(): ?Amount
    {
        return $this->need;
    }

    public function setNeed(?Amount $need): static
    {
        $this->need = $need;

        return $this;
    }

    public function getCollected(): ?Amount
    {
        return $this->collected;
    }

    public function setCollected(?Amount $collected): static
    {
        $this->collected = $collected;

        return $this;
    }


}
