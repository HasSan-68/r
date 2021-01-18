<?php

namespace App\Entity;

use App\Repository\MedewerkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedewerkerRepository::class)
 */
class Medewerker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $achternaam;

    /**
     * @ORM\OneToMany(targetEntity=Bestellingen::class, mappedBy="Medewerker_id")
     */
    private $bestellingens;

    /**
     * @ORM\OneToMany(targetEntity=Bon::class, mappedBy="Mederwerker_id")
     */
    private $bons;

    public function __construct()
    {
        $this->bestellingens = new ArrayCollection();
        $this->bons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    /**
     * @return Collection|Bestellingen[]
     */
    public function getBestellingens(): Collection
    {
        return $this->bestellingens;
    }

    public function addBestellingen(Bestellingen $bestellingen): self
    {
        if (!$this->bestellingens->contains($bestellingen)) {
            $this->bestellingens[] = $bestellingen;
            $bestellingen->setMedewerkerId($this);
        }

        return $this;
    }

    public function removeBestellingen(Bestellingen $bestellingen): self
    {
        if ($this->bestellingens->removeElement($bestellingen)) {
            // set the owning side to null (unless already changed)
            if ($bestellingen->getMedewerkerId() === $this) {
                $bestellingen->setMedewerkerId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bon[]
     */
    public function getBons(): Collection
    {
        return $this->bons;
    }

    public function addBon(Bon $bon): self
    {
        if (!$this->bons->contains($bon)) {
            $this->bons[] = $bon;
            $bon->setMederwerkerId($this);
        }

        return $this;
    }

    public function removeBon(Bon $bon): self
    {
        if ($this->bons->removeElement($bon)) {
            // set the owning side to null (unless already changed)
            if ($bon->getMederwerkerId() === $this) {
                $bon->setMederwerkerId(null);
            }
        }

        return $this;
    }
    /**
     * @param mixed $id
     */
    public function __toString() {
        return $this->getNaam();
    }
}
