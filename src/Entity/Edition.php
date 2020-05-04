<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EditionRepository")
 */
class Edition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $editionNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $station;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Race", inversedBy="editions")
     */
    private $races;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="editions")
     */
    private $teams;

    public function __construct()
    {
        $this->races = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getEditionNumber(): ?int
    {
        return $this->editionNumber;
    }

    public function setEditionNumber(int $editionNumber): self
    {
        $this->editionNumber = $editionNumber;

        return $this;
    }

    public function getStation(): ?string
    {
        return $this->station;
    }

    public function setStation(string $station): self
    {
        $this->station = $station;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->contains($race)) {
            $this->races->removeElement($race);
        }

        return $this;
    }

    public function getTeams(): ?Team
    {
        return $this->teams;
    }

    public function setTeams(?Team $teams): self
    {
        $this->teams = $teams;

        return $this;
    }
}
