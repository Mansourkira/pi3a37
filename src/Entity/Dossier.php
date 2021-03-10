<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DossierRepository::class)
 */
class Dossier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $nDossier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Antecedents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Suivi;

    public function getNDossier(): ?int
    {
        return $this->nDossier;
    }

    public function getAntecedents(): ?string
    {
        return $this->Antecedents;
    }

    public function setAntecedents(string $Antecedents): self
    {
        $this->Antecedents = $Antecedents;

        return $this;
    }

    public function getSuivi(): ?string
    {
        return $this->Suivi;
    }

    public function setSuivi(string $Suivi): self
    {
        $this->Suivi = $Suivi;

        return $this;
    }
}
