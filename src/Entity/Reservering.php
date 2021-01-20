<?php

namespace App\Entity;

use App\Repository\ReserveringRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ReserveringRepository::class)
 * @UniqueEntity(
 *     fields={"datum", "status"},
 *     errorPath="index",
 *     message="This datum and hours are already in use on that host."
 * )
 * source: https://symfony.com/doc/current/reference/constraints/UniqueEntity.html#fields
 */
class Reservering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Tafel::class, inversedBy="reserverings")
     */
    private $Tafel_id;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="reserverings")
     */
    private $Klant_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTafelId(): ?Tafel
    {
        return $this->Tafel_id;
    }

    public function setTafelId(?Tafel $Tafel_id): self
    {
        $this->Tafel_id = $Tafel_id;

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
    public function __toString()
    {
        return $this->id.'->'.$this->getTafelId();
    }

}

