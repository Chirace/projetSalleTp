<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\LogicielRepository")
 */
class Logiciel {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ordinateur",
     * inversedBy="logiciel_installes", cascade="persist")
     */
    private $machine_installees;

    public function __construct()
    {
        $this->machine_installees = new ArrayCollection();
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

    /**
     * @return Collection|Ordinateur[]
     */
    public function getMachineInstallees(): Collection
    {
        return $this->machine_installees;
    }

    public function addMachineInstallee(Ordinateur $machineInstallee): self
    {
        if (!$this->machine_installees->contains($machineInstallee)) {
            $this->machine_installees[] = $machineInstallee;
        }

        return $this;
    }

    public function removeMachineInstallee(Ordinateur $machineInstallee): self
    {
        if ($this->machine_installees->contains($machineInstallee)) {
            $this->machine_installees->removeElement($machineInstallee);
        }

        return $this;
    }
}
