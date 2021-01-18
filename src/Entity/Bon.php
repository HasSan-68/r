<?php

namespace App\Entity;

use App\Repository\BonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonRepository::class)
 */
class Bon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Medewerker::class, inversedBy="bons")
     */
    private $Mederwerker_id;

    /**
     * @ORM\OneToOne(targetEntity=Klant::class)
     */
    private $Klant_id;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\ManyToOne(targetEntity=Bestellingen::class, inversedBy="bons")
     */
    private $Bestelling_id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totaal_bedrag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMederwerkerId(): ?Medewerker
    {
        return $this->Mederwerker_id;
    }

    public function setMederwerkerId(?Medewerker $Mederwerker_id): self
    {
        $this->Mederwerker_id = $Mederwerker_id;

        return $this;
    }

    public function getKlantId(): ?Klant
    {
        return $this->Klant_id;
    }

    public function setKlantId(?Klant $Klant_id): self
    {
        $this->Klant_id = $Klant_id;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getBestellingId(): ?Bestellingen
    {
        return $this->Bestelling_id;
    }

    public function setBestellingId(?Bestellingen $Bestelling_id): self
    {
        $this->Bestelling_id = $Bestelling_id;

        return $this;
    }

    public function getTotaalBedrag(): ?float
    {
        return $this->totaal_bedrag;
    }

    public function setTotaalBedrag(?float $totaal_bedrag): self
    {
        $this->totaal_bedrag = $totaal_bedrag;

        return $this;
    }
    public function __toString()
    {
        return $this->id.'->'.$this->getBestellingId();
    }



}
