<?php

namespace App\Entity;

use App\Repository\BestellingenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BestellingenRepository", repositoryClass=BestellingenRepository::class)
 */
class Bestellingen
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
    private $voorgerecht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nagerecht;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prijs;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datum;

    /**
     * @ORM\ManyToOne(targetEntity=Medewerker::class, inversedBy="bestellingens")
     */
    private $Medewerker_id;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="bestellingens")
     */
    private $Klant_id;

    /**
     * @ORM\OneToMany(targetEntity=Bon::class, mappedBy="bestelling_id")
     */
    private $bons;

    public function __construct()
    {
        $this->bons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoorgerecht(): ?string
    {
        return $this->voorgerecht;
    }

    public function setVoorgerecht(string $voorgerecht): self
    {
        $this->voorgerecht = $voorgerecht;

        return $this;
    }

    public function getNagerecht(): ?string
    {
        return $this->nagerecht;
    }

    public function setNagerecht(string $nagerecht): self
    {
        $this->nagerecht = $nagerecht;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(?float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getMedewerkerId(): ?Medewerker
    {
        return $this->Medewerker_id;
    }

    public function setMedewerkerId(?Medewerker $Medewerker_id): self
    {
        $this->Medewerker_id = $Medewerker_id;

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
            $bon->setBestellingId($this);
        }

        return $this;
    }

    public function removeBon(Bon $bon): self
    {
        if ($this->bons->removeElement($bon)) {
            // set the owning side to null (unless already changed)
            if ($bon->getBestellingId() === $this) {
                $bon->setBestellingId(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->id.'->'.$this->getNagerecht();
    }



}
