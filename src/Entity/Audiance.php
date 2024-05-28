<?php

// src/Entity/Audiance.php

namespace App\Entity;

use App\Repository\AudienceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;



#[ORM\Entity(repositoryClass: AudienceRepository::class)]

class Audiance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $room = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $courtDate = null;

    #[ORM\ManyToOne(targetEntity: Dossier::class, inversedBy: 'audiances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dossier $dossier = null;

    #[ORM\ManyToMany(targetEntity: Judge::class)]
    private Collection $judges;

    public function getId(): ?int
    {
        return $this->id;

    }
    public function __construct()
    {
        $this->judges = new ArrayCollection();
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(string $room): self
    {
        $this->room = $room;
        return $this;
    }

    public function getCourtDate(): ?\DateTimeInterface
    {
        return $this->courtDate;
    }

    public function setCourtDate(\DateTimeInterface $courtDate): self
    {
        $this->courtDate = $courtDate;
        return $this;
    }
    public function getJudges(): Collection
    {
        return $this->judges;
    }

    public function addJudge(Judge $judge): static
    {
        if (!$this->judges->contains($judge)) {
            $this->judges[] = $judge;
        }

        return $this;
    }

    public function removeJudge(Judge $judge): static
    {
        $this->judges->removeElement($judge);

        return $this;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;
        return $this;
    }
}
