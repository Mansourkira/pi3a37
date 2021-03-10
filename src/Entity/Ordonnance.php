<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdonnanceRepository::class)
 */
class Ordonnance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $nOrdonnance;

    /**
     * @ORM\Column(type="date")
     */
    private $dateord;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $traitement;

    public function getNOrdonnance(): ?int
    {
        return $this->nOrdonnance;
    }

    public function getDateord(): ?\DateTimeInterface
    {
        return $this->dateord;
    }

    public function setDateord(\DateTimeInterface $dateord): self
    {
        $this->dateord = $dateord;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }
}
