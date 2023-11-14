<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Flex\Path as FlexPath;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Filesystem\Path;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\InvestGetController;
use App\Filter\InvestCustomsSearchFilter;
use App\Controller\CreateInvestController;
use Doctrine\Common\Collections\Collection;
use App\Controller\GetInvestmentsController;
use App\Repository\InvestissementRepository;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InvestissementRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: [
        'groups' => ['invest_read']
    ],
    operations: [
        new GetCollection(),
        new Get(),
        // new Get(
        //     controller: GetInvestmentsController::class,
        // ),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: CreateInvestController::class,
            deserialize: false
        ),
    ]
)]
class Investissement
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $need = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank([
        'message' => 'ce champ est obligatoire'
    ])]
    #[Groups(['company_read', 'invest_read'])]
    private ?string $collected = null;

    #[ORM\ManyToMany(targetEntity: Domaine::class, mappedBy: 'Invest')]
    #[ORM\JoinColumn(name: "domaine-invest")]
    #[Groups(['company_read', 'invest_read'])]
    private Collection $domaines;

    #[ORM\ManyToOne(targetEntity:Author::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['posts_read','image_read', 'invest_read'])]
    private ?Author $author = null;

    #[ORM\OneToMany(mappedBy: 'investissement', targetEntity: InvestPicture::class)]
    #[Groups(['image_read', 'invest_read'])]
    private Collection $InvestPicture;


    public function __construct()
    {
        $this->domaines = new ArrayCollection();
        $this->InvestPicture = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNeed(): ?string
    {
        return $this->need;
    }

    public function setNeed(string $need): static
    {
        $this->need = $need;

        return $this;
    }

    public function getCollected(): ?string
    {
        return $this->collected;
    }

    public function setCollected(string $collected): static
    {
        $this->collected = $collected;

        return $this;
    }


    /**
     * @return Collection<int, Domaine>
     */
    public function getDomaines(): Collection
    {
        return $this->domaines;
    }

    public function addDomaine(Domaine $domaine): static
    {
        if (!$this->domaines->contains($domaine)) {
            $this->domaines->add($domaine);
            $domaine->addInvest($this);
        }

        return $this;
    }

    public function removeDomaine(Domaine $domaine): static
    {
        if ($this->domaines->removeElement($domaine)) {
            $domaine->removeInvest($this);
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
    public function getInvestPicture(): Collection
    {
        return $this->InvestPicture;
    }

    public function addInvestPicture(InvestPicture $investPicture): static
    {
        if (!$this->InvestPicture->contains($investPicture)) {
            $this->InvestPicture->add($investPicture);
            $investPicture->setInvestissement($this);
        }

        return $this;
    }

    public function removeInvestPicture(InvestPicture $investPicture): static
    {
        if ($this->InvestPicture->removeElement($investPicture)) {
            if ($investPicture->getInvestissement() === $this) {
                $investPicture->setInvestissement(null);
            }
        }

        return $this;
    }

   
}
