<?php

namespace App\Entity;

use App\Repository\TafelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TafelRepository::class)
 */
class Tafel
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
    private $grootte;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $aantal_stoelen;

    /**
     * @ORM\OneToMany(targetEntity=Reservering::class, mappedBy="Tafel_id")
     */
    private $reserverings;

    public function __construct()
    {
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrootte(): ?string
    {
        return $this->grootte;
    }

    public function setGrootte(?string $grootte): self
    {
        $this->grootte = $grootte;

        return $this;
    }

    public function getAantalStoelen(): ?int
    {
        return $this->aantal_stoelen;
    }

    public function setAantalStoelen(?int $aantal_stoelen): self
    {
        $this->aantal_stoelen = $aantal_stoelen;

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
            $reservering->setTafelId($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getTafelId() === $this) {
                $reservering->setTafelId(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->id.'->'.$this->getAantalStoelen();
    }

}
