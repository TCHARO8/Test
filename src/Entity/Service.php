<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleS = null;

    #[ORM\Column]
    private ?int $idd = null;

    #[ORM\ManyToOne(inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: false)]
    private ?departement $departementId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelleS(): ?string
    {
        return $this->libelleS;
    }

    public function setLibelleS(string $libelleS): static
    {
        $this->libelleS = $libelleS;

        return $this;
    }

    public function getIdd(): ?int
    {
        return $this->idd;
    }

    public function setIdd(int $idd): static
    {
        $this->idd = $idd;

        return $this;
    }

    public function getDepartementId(): ?departement
    {
        return $this->departementId;
    }

    public function setDepartementId(?departement $departementId): static
    {
        $this->departementId = $departementId;

        return $this;
    }
}
