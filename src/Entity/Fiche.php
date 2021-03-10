<?php

namespace App\Entity;

use App\Repository\FicheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FicheRepository::class)
 */
class Fiche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $nfiche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomp;

    /**
     * @ORM\Column(type="date")
     */
    private $datenaiss;

    /**
     * @ORM\Column(type="integer")
     */
    private $numerop;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    public function getNfiche(): ?int
    {
        return $this->nfiche;
    }

    public function getNomp(): ?string
    {
        return $this->nomp;
    }

    public function setNomp(string $nomp): self
    {
        $this->nomp = $nomp;

        return $this;
    }

    public function getPrenomp(): ?string
    {
        return $this->prenomp;
    }

    public function setPrenomp(string $prenomp): self
    {
        $this->prenomp = $prenomp;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(\DateTimeInterface $datenaiss): self
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    public function getNumerop(): ?int
    {
        return $this->numerop;
    }

    public function setNumerop(int $numerop): self
    {
        $this->numerop = $numerop;

        return $this;
    }

    public function getSexep(): ?string
    {
        return $this->sexep;
    }

    public function setSexep(string $sexep): self
    {
        $this->sexep = $sexep;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
