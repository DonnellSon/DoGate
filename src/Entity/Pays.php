<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post as MetadataPost;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaysRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\PaysController;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(
            controller: PaysController::class,
            deserialize: false,
        ),
        new Put(),
        new Patch(),
        new MetadataPost()
    ]
)]
class Pays
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'pays')]
    private ?Localisation $localisation = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLocalisation(): ?Localisation
    {
        return $this->localisation;
    }

    public function setLocalisation(?Localisation $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }
}




































































































































































































// created By Nyaina