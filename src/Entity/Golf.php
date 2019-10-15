<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GolfRepository")
 */
class Golf
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
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="golf")
     */
    private $competition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trou", mappedBy="golf")
     */
    private $trou;

    public function __construct()
    {
        $this->competition = new ArrayCollection();
        $this->trou = new ArrayCollection();
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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetition(): Collection
    {
        return $this->competition;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competition->contains($competition)) {
            $this->competition[] = $competition;
            $competition->setGolf($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competition->contains($competition)) {
            $this->competition->removeElement($competition);
            // set the owning side to null (unless already changed)
            if ($competition->getGolf() === $this) {
                $competition->setGolf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trou[]
     */
    public function getTrou(): Collection
    {
        return $this->trou;
    }

    public function addTrou(Trou $trou): self
    {
        if (!$this->trou->contains($trou)) {
            $this->trou[] = $trou;
            $trou->setGolf($this);
        }

        return $this;
    }

    public function removeTrou(Trou $trou): self
    {
        if ($this->trou->contains($trou)) {
            $this->trou->removeElement($trou);
            // set the owning side to null (unless already changed)
            if ($trou->getGolf() === $this) {
                $trou->setGolf(null);
            }
        }

        return $this;
    }
}
