<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatTypeRepository")
 */
class StatType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stats", mappedBy="statType")
     */
    private $stat;

    public function __construct()
    {
        $this->sensor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Stats[]
     */
    public function getStat(): Collection
    {
        return $this->stat;
    }

    public function addStat(Stats $stat): self
    {
        if (!$this->stat->contains($stat)) {
            $this->stat[] = $stat;
            $stat->setStatType($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stat->contains($stat)) {
            $this->stat->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getStatType() === $this) {
                $stat->setStatType(null);
            }
        }

        return $this;
    }
}
