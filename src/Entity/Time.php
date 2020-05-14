<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeRepository")
 */
class Time
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attemp1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attemp2;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $statusAttemp1;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $statusAttemp2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penality1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penality2;

    /**
     * @ORM\Column(type="integer")
     */
    private $jerseyNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competitor", mappedBy="time")
     */
    private $competitors;

    public function __construct()
    {
        $this->competitors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttemp1(): ?int
    {
        return $this->attemp1;
    }

    public function setAttemp1(?int $attemp1): self
    {
        $this->attemp1 = $attemp1;

        return $this;
    }

    public function getAttemp2(): ?int
    {
        return $this->attemp2;
    }

    public function setAttemp2(?int $attemp2): self
    {
        $this->attemp2 = $attemp2;

        return $this;
    }

    public function getStatusAttemp1(): ?string
    {
        return $this->statusAttemp1;
    }

    public function setStatusAttemp1(?string $statusAttemp1): self
    {
        $this->statusAttemp1 = $statusAttemp1;

        return $this;
    }

    public function getStatusAttemp2(): ?string
    {
        return $this->statusAttemp2;
    }

    public function setStatusAttemp2(?string $statusAttemp2): self
    {
        $this->statusAttemp2 = $statusAttemp2;

        return $this;
    }

    public function getPenality1(): ?int
    {
        return $this->penality1;
    }

    public function setPenality1(?int $penality1): self
    {
        $this->penality1 = $penality1;

        return $this;
    }

    public function getPenality2(): ?int
    {
        return $this->penality2;
    }

    public function setPenality2(?int $penality2): self
    {
        $this->penality2 = $penality2;

        return $this;
    }

    public function getJerseyNumber(): ?int
    {
        return $this->jerseyNumber;
    }

    public function setJerseyNumber(int $jerseyNumber): self
    {
        $this->jerseyNumber = $jerseyNumber;

        return $this;
    }

    /**
     * @return Collection|Competitor[]
     */
    public function getCompetitors(): Collection
    {
        return $this->competitors;
    }

    public function addCompetitor(Competitor $competitor): self
    {
        if (!$this->competitors->contains($competitor)) {
            $this->competitors[] = $competitor;
            $competitor->setTime($this);
        }

        return $this;
    }

    public function removeCompetitor(Competitor $competitor): self
    {
        if ($this->competitors->contains($competitor)) {
            $this->competitors->removeElement($competitor);
            // set the owning side to null (unless already changed)
            if ($competitor->getTime() === $this) {
                $competitor->setTime(null);
            }
        }

        return $this;
    }
}
