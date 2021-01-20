<?php

namespace App\Entity;

use App\Repository\KlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlantRepository::class)
 */
class Klant
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
     * @ORM\Column(type="integer")
     */
    private $telefoonnummer;

    /**
     * @ORM\OneToMany(targetEntity=Betaalmethode::class, mappedBy="Klant_id")
     */
    private $betaalmethodes;

    /**
     * @ORM\OneToMany(targetEntity=Reservering::class, mappedBy="Klant_id")
     */
    private $reserverings;

    /**
     * @ORM\OneToMany(targetEntity=Bestellingen::class, mappedBy="Klant_id")
     */
    private $bestellingens;

    public function __construct()
    {
        $this->betaalmethodes = new ArrayCollection();
        $this->reserverings = new ArrayCollection();
        $this->bestellingens = new ArrayCollection();
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

    public function getTelefoonnummer(): ?int
    {
        return $this->telefoonnummer;
    }

    public function setTelefoonnummer(int $telefoonnummer): self
    {
        $this->telefoonnummer = $telefoonnummer;

        return $this;
    }

    /**
     * @return Collection|Betaalmethode[]
     */
    public function getBetaalmethodes(): Collection
    {
        return $this->betaalmethodes;
    }

    public function addBetaalmethode(Betaalmethode $betaalmethode): self
    {
        if (!$this->betaalmethodes->contains($betaalmethode)) {
            $this->betaalmethodes[] = $betaalmethode;
            $betaalmethode->setKlantId($this);
        }

        return $this;
    }

    public function removeBetaalmethode(Betaalmethode $betaalmethode): self
    {
        if ($this->betaalmethodes->removeElement($betaalmethode)) {
            // set the owning side to null (unless already changed)
            if ($betaalmethode->getKlantId() === $this) {
                $betaalmethode->setKlantId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setKlantId($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getKlantId() === $this) {
                $reservering->setKlantId(null);
            }
        }

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
            $bestellingen->setKlantId($this);
        }

        return $this;
    }

    public function removeBestellingen(Bestellingen $bestellingen): self
    {
        if ($this->bestellingens->removeElement($bestellingen)) {
            // set the owning side to null (unless already changed)
            if ($bestellingen->getKlantId() === $this) {
                $bestellingen->setKlantId(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->getNaam() .' '. $this->getAchternaam() ;
    }
}
