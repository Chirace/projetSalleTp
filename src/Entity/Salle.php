<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(min=1, max=1,
     * exactMessage="Votre nom doit faire {{ limit }} caractère")
     */
    private $batiment;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Regex(pattern="/^[0-9]$/",
     * message="la valeur doit être comprise entre 0 et 9.")
     */
    private $etage;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\LessThanOrEqual(value = 80,
     * message="la valeur doit être <= {{ compared_value }}")
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
