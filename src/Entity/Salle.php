<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalleRepository")
 */
class Salle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $batiment;

    /**
     * @ORM\Column(type="smallint")
     */
    private $etage;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBatiment(): ?string
    {
        return $this->batiment;
    }

    public function setBatiment(string $batiment): self
    {
        $this->batiment = $batiment;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
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

    public function __toString() {
        return $this->getBatiment().'-'.$this->getEtage().'.'.$this->getNumero();
       }
}
