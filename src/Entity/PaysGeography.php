<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PaysGeographyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PaysGeographyRepository::class)]
#[ApiResource(
    normalizationContext:
    ['groups'=>['pays_read']]
)]
class PaysGeography
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'App\Doctrine\Base58UuidGenerator')]
    private ?string $id = null;

    #[Column(type: 'json')]
    #[Groups(['pays_read'])]
    private array $extraData = [];

    #[ORM\OneToMany(mappedBy: 'paysGeography', targetEntity: Pays::class)]
    private Collection $pays;

    public function __construct()
    {
        $this->pays = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
            $pay->setPaysGeography($this);
        }

        return $this;
    }

    public function removePay(Pays $pay): static
    {
        if ($this->pays->removeElement($pay)) {
            // set the owning side to null (unless already changed)
            if ($pay->getPaysGeography() === $this) {
                $pay->setPaysGeography(null);
            }
        }

        return $this;
    }

    public function getExtraData(): array
    {
        return $this->extraData;
    }

    public function setExtraData($extraData): self
    {
        $this->extraData = $extraData;

        return $this;
    }
}
