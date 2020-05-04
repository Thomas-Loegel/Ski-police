<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $teamName;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $city;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competitor", mappedBy="team")
     */
    private $competitors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Edition", mappedBy="teams")
     */
    private $editions;

    public function __construct()
    {
        $this->competitors = new ArrayCollection();
        $this->editions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): self
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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
            $competitor->addTeam($this);
        }

        return $this;
    }

    public function removeCompetitor(Competitor $competitor): self
    {
        if ($this->competitors->contains($competitor)) {
            $this->competitors->removeElement($competitor);
            $competitor->removeTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection|Edition[]
     */
    public function getEditions(): Collection
    {
        return $this->editions;
    }

    public function addEdition(Edition $edition): self
    {
        if (!$this->editions->contains($edition)) {
            $this->editions[] = $edition;
            $edition->setTeams($this);
        }

        return $this;
    }

    public function removeEdition(Edition $edition): self
    {
        if ($this->editions->contains($edition)) {
            $this->editions->removeElement($edition);
            // set the owning side to null (unless already changed)
            if ($edition->getTeams() === $this) {
                $edition->setTeams(null);
            }
        }

        return $this;
    }
}
