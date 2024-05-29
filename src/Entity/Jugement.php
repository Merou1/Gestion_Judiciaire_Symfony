<?php

namespace App\Entity;

use App\Repository\JugementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugementRepository::class)]
class Jugement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    #[ORM\Column(type: "text")]
    private ?string $jugements = null;

    #[ORM\ManyToOne(targetEntity: Audiance::class, inversedBy: "jugements")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Audiance $audiance = null;


    public function getJugements(): ?string
    {
        return $this->jugements;
    }

    public function setJugements(string $description): self
    {
        $this->jugements = $description;

        return $this;
    }

    public function getAudiance(): ?Audiance
    {
        return $this->audiance;
    }

    public function setAudiance(?Audiance $audiance): self
    {
        $this->audiance = $audiance;

        return $this;
    }

}
