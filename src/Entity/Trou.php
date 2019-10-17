<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrouRepository")
 */
class Trou
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="time")
     */
    private $tempsRef;

    /**
     * @ORM\Column(type="integer")
     */
    private $par;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Golf", inversedBy="trou")
     * @ORM\JoinColumn(nullable=false)
     */
    private $golf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TrouPartie", mappedBy="trou")
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

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTempsRef(): ?DateTimeInterface
    {
        return $this->tempsRef;
    }

    public function setTempsRef(DateTimeInterface $tempsRef): self
    {
        $this->tempsRef = $tempsRef;

        return $this;
    }

    public function getPar(): ?int
    {
        return $this->par;
    }

    public function setPar(int $par): self
    {
        $this->par = $par;

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
            $trouParty->setTrou($this);
        }

        return $this;
    }

    public function removeTrouParty(TrouPartie $trouParty): self
    {
        if ($this->trouParties->contains($trouParty)) {
            $this->trouParties->removeElement($trouParty);
            // set the owning side to null (unless already changed)
            if ($trouParty->getTrou() === $this) {
                $trouParty->setTrou(null);
            }
        }

        return $this;
    }
}
