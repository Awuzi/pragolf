<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrouPartieRepository")
 */
class TrouPartie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $depassement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trou", inversedBy="trouParties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trou;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partie", inversedBy="trouParties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepassement(): ?int
    {
        return $this->depassement;
    }

    public function setDepassement(?int $depassement): self
    {
        $this->depassement = $depassement;

        return $this;
    }

    public function getTrou(): ?Trou
    {
        return $this->trou;
    }

    public function setTrou(?Trou $trou): self
    {
        $this->trou = $trou;

        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }

    public function setPartie(?Partie $partie): self
    {
        $this->partie = $partie;

        return $this;
    }
}
