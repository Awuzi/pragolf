<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $heureDepart;

    /**
     * @ORM\Column(type="integer")
     */
    private $minuteDepart;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Golf", inversedBy="competition")
     * @ORM\JoinColumn(nullable=true)
     */
    private $golf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="competition")
     */
    private $partie;

    /**
     * @ORM\Column(type="integer")
     */
    private $cadence;

    /**
     * @ORM\Column(type="blob")
     */
    private $fichier;

    /**
     * @ORM\Column(type="text")
     */
    private $nomCompet;

    /**
     * @ORM\Column(type="text")
     */
    private $nomGolf;

    public function __construct()
    {
        $this->partie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDepart(): ?int
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(int $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getMinuteDepart(): ?int
    {
        return $this->minuteDepart;
    }

    public function setMinuteDepart(int $minuteDepart): self
    {
        $this->minuteDepart = $minuteDepart;

        return $this;
    }


    public function getGolf(): ?Golf
    {
        return $this->golf;
    }

    public function gol(?Golf $golf): self
    {
        $this->golf = $golf;

        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getPartie(): Collection
    {
        return $this->partie;
    }

    public function addPartie(Partie $partie): self
    {
        if (!$this->partie->contains($partie)) {
            $this->partie[] = $partie;
            $partie->setCompetition($this);
        }

        return $this;
    }

    public function removePartie(Partie $partie): self
    {
        if ($this->partie->contains($partie)) {
            $this->partie->removeElement($partie);
            // set the owning side to null (unless already changed)
            if ($partie->getCompetition() === $this) {
                $partie->setCompetition(null);
            }
        }

        return $this;
    }

    public function getCadence(): ?int
    {
        return $this->cadence;
    }

    public function setCadence(int $cadence): self
    {
        $this->cadence = $cadence;

        return $this;
    }

    public function getFichier()
    {
        return $this->fichier;
    }

    public function setFichier($fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getNomCompet(): ?string
    {
        return $this->nomCompet;
    }

    public function setNomCompet(string $nomCompet): self
    {
        $this->nomCompet = $nomCompet;

        return $this;
    }

    public function getNomGolf(): ?string
    {
        return $this->nomGolf;
    }

    public function setNomGolf(string $nomGolf): self
    {
        $this->nomGolf = $nomGolf;

        return $this;
    }
}
