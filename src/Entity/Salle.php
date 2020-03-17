<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalleRepository")
 * @ORM\HasLifecycleCallbacks()
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordinateur", mappedBy="salle")
     */
    private $ordinateurs;

    public function __construct()
    {
        $this->ordinateurs = new ArrayCollection();
    }

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

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function corrigeNomBatiment() {
        $this->batiment = strtoupper($this->batiment);
    }

    /**
     * @return Collection|Ordinateur[]
     */
    public function getOrdinateurs(): Collection
    {
        return $this->ordinateurs;
    }

    public function addOrdinateur(Ordinateur $ordinateur): self
    {
        if (!$this->ordinateurs->contains($ordinateur)) {
            $this->ordinateurs[] = $ordinateur;
            $ordinateur->setSalle($this);
        }

        return $this;
    }

    public function removeOrdinateur(Ordinateur $ordinateur): self
    {
        if ($this->ordinateurs->contains($ordinateur)) {
            $this->ordinateurs->removeElement($ordinateur);
            // set the owning side to null (unless already changed)
            if ($ordinateur->getSalle() === $this) {
                $ordinateur->setSalle(null);
            }
        }

        return $this;
    }
}
