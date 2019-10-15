<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDepart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="partie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TrouPartie", mappedBy="partie")
     */
    private $trouParties;

    public function __construct()
    {
        $this->trouParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * @return Collection|TrouPartie[]
     */
    public function getTrouParties(): Collection
    {
        return $this->trouParties;
    }

    public function addTrouParty(TrouPartie $trouParty): self
    {
        if (!$this->trouParties->contains($trouParty)) {
            $this->trouParties[] = $trouParty;
            $trouParty->setPartie($this);
        }

        return $this;
    }

    public function removeTrouParty(TrouPartie $trouParty): self
    {
        if ($this->trouParties->contains($trouParty)) {
            $this->trouParties->removeElement($trouParty);
            // set the owning side to null (unless already changed)
            if ($trouParty->getPartie() === $this) {
                $trouParty->setPartie(null);
            }
        }

        return $this;
    }
}
