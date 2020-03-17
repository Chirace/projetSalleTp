<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdinateurRepository")
 */
class Ordinateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $ip;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marque"), cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle", inversedBy="ordinateurs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $salle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Logiciel",
     * mappedBy="machine_installees", cascade="persist")
     */
    private $logiciel_installes;

    public function __construct()
    {
        $this->logiciel_installes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return Collection|Logiciel[]
     */
    public function getLogicielInstalles(): Collection
    {
        return $this->logiciel_installes;
    }

    public function addLogicielInstalle(Logiciel $logicielInstalle): self
    {
        if (!$this->logiciel_installes->contains($logicielInstalle)) {
            $this->logiciel_installes[] = $logicielInstalle;
            $logicielInstalle->addMachineInstallee($this);
        }

        return $this;
    }

    public function removeLogicielInstalle(Logiciel $logicielInstalle): self
    {
        if ($this->logiciel_installes->contains($logicielInstalle)) {
            $this->logiciel_installes->removeElement($logicielInstalle);
            $logicielInstalle->removeMachineInstallee($this);
        }

        return $this;
    }
}
