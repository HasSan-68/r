<?php

namespace App\Entity;

use App\Repository\BetaalmethodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BetaalmethodeRepository::class)
 */
class Betaalmethode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $betaalwijze;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="betaalmethodes")
     */
    private $Klant_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBetaalwijze(): ?string
    {
        return $this->betaalwijze;
    }

    public function setBetaalwijze(?string $betaalwijze): self
    {
        $this->betaalwijze = $betaalwijze;

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
}
