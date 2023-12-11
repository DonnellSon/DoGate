<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\JobOfferRepository;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\CreateJobOfferController;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Post as MetadataPost;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['job_offers_read']
    ],
    operations: [
        new GetCollection(),
        new Get(),
        new Put(),
        new Patch(),
        new MetadataPost(
            controller: CreateJobOfferController::class,
            deserialize: false
        ),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['title' => 'partial'])]
class JobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['users_read','job_offers_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_read','job_offers_read'])]
    #[Assert\NotBlank(message:'Le titre est obligatoire !')]
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['users_read','job_offers_read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users_read','job_offers_read'])]
    private ?string $xp = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['users_read','job_offers_read'])]
    private ?string $summary = null;

    #[ORM\Column(length: 255)]
    #[Groups(['users_read','job_offers_read'])]
    #[Assert\NotBlank(message:'La déscription est obligatoire !')]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    #[Groups(['users_read','job_offers_read'])]
    #[Assert\NotBlank(message:'L\'auteur est obligatoire !')]
    private ?Author $author = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    #[Assert\NotBlank(message:'Le grade est obligatoire !')]
    #[Groups(['users_read','job_offers_read'])]
    private ?JobGrade $grade = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Le type est obligatoire !')]
    #[Groups(['users_read','job_offers_read'])]
    private ?JobType $type = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Assert\NotBlank(message:'Le salaire est obligatoire !')]
    #[Groups(['users_read','job_offers_read'])]
    private ?Salary $salary = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getXp(): ?string
    {
        return $this->xp;
    }

    public function setXp(?string $xp): static
    {
        $this->xp = $xp;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

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

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getGrade(): ?JobGrade
    {
        return $this->grade;
    }

    public function setGrade(?JobGrade $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getType(): ?JobType
    {
        return $this->type;
    }

    public function setType(?JobType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSalary(): ?Salary
    {
        return $this->salary;
    }

    public function setSalary(?Salary $salary): static
    {
        $this->salary = $salary;

        return $this;
    }
}
