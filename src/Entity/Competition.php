<?php

namespace App\Entity;

use DateTimeInterface;
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
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Golf", inversedBy="competition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $golf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="competition")
     */
    private $partie;

    /**
     * @ORM\Column(type="time")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDepart(): ?DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getGolf(): ?Golf
    {
        return $this->golf;
    }

    public function setGolf(?Golf $golf): self
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

    public function getCadence(): ?DateTimeInterface
    {
        return $this->cadence;
    }

    public function setCadence(DateTimeInterface $cadence): self
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
