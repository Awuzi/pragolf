<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UploadTrouRepository")
 */
class UploadTrou
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $GolfID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou6;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou7;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou8;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou9;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou10;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou11;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou12;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou13;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou14;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou15;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou16;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou17;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Trou18;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGolfID(): ?int
    {
        return $this->GolfID;
    }

    public function setGolfID(?int $GolfID): self
    {
        $this->GolfID = $GolfID;

        return $this;
    }

    public function getTrou1(): ?int
    {
        return $this->Trou1;
    }

    public function setTrou1(?int $Trou1): self
    {
        $this->Trou1 = $Trou1;

        return $this;
    }

    public function getTrou2(): ?int
    {
        return $this->Trou2;
    }

    public function setTrou2(?int $Trou2): self
    {
        $this->Trou2 = $Trou2;

        return $this;
    }

    public function getTrou3(): ?int
    {
        return $this->Trou3;
    }

    public function setTrou3(?int $Trou3): self
    {
        $this->Trou3 = $Trou3;

        return $this;
    }

    public function getTrou4(): ?int
    {
        return $this->Trou4;
    }

    public function setTrou4(?int $Trou4): self
    {
        $this->Trou4 = $Trou4;

        return $this;
    }

    public function getTrou5(): ?int
    {
        return $this->Trou5;
    }

    public function setTrou5(?int $Trou5): self
    {
        $this->Trou5 = $Trou5;

        return $this;
    }

    public function getTrou6(): ?int
    {
        return $this->Trou6;
    }

    public function setTrou6(?int $Trou6): self
    {
        $this->Trou6 = $Trou6;

        return $this;
    }

    public function getTrou7(): ?int
    {
        return $this->Trou7;
    }

    public function setTrou7(?int $Trou7): self
    {
        $this->Trou7 = $Trou7;

        return $this;
    }

    public function getTrou8(): ?int
    {
        return $this->Trou8;
    }

    public function setTrou8(?int $Trou8): self
    {
        $this->Trou8 = $Trou8;

        return $this;
    }

    public function getTrou9(): ?int
    {
        return $this->Trou9;
    }

    public function setTrou9(?int $Trou9): self
    {
        $this->Trou9 = $Trou9;

        return $this;
    }

    public function getTrou10(): ?int
    {
        return $this->Trou10;
    }

    public function setTrou10(?int $Trou10): self
    {
        $this->Trou10 = $Trou10;

        return $this;
    }

    public function getTrou11(): ?int
    {
        return $this->Trou11;
    }

    public function setTrou11(?int $Trou11): self
    {
        $this->Trou11 = $Trou11;

        return $this;
    }

    public function getTrou12(): ?int
    {
        return $this->Trou12;
    }

    public function setTrou12(?int $Trou12): self
    {
        $this->Trou12 = $Trou12;

        return $this;
    }

    public function getTrou13(): ?int
    {
        return $this->Trou13;
    }

    public function setTrou13(?int $Trou13): self
    {
        $this->Trou13 = $Trou13;

        return $this;
    }

    public function getTrou14(): ?int
    {
        return $this->Trou14;
    }

    public function setTrou14(?int $Trou14): self
    {
        $this->Trou14 = $Trou14;

        return $this;
    }

    public function getTrou15(): ?int
    {
        return $this->Trou15;
    }

    public function setTrou15(?int $Trou15): self
    {
        $this->Trou15 = $Trou15;

        return $this;
    }

    public function getTrou16(): ?int
    {
        return $this->Trou16;
    }

    public function setTrou16(?int $Trou16): self
    {
        $this->Trou16 = $Trou16;

        return $this;
    }

    public function getTrou17(): ?int
    {
        return $this->Trou17;
    }

    public function setTrou17(?int $Trou17): self
    {
        $this->Trou17 = $Trou17;

        return $this;
    }

    public function getTrou18(): ?int
    {
        return $this->Trou18;
    }

    public function setTrou18(?int $Trou18): self
    {
        $this->Trou18 = $Trou18;

        return $this;
    }
}
