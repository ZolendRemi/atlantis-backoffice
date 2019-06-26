<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SensorsRepository")
 */
class Sensors
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devices", inversedBy="sensor", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $device;

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stats", mappedBy="sensor")
     */
    private $stats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Datas", mappedBy="sensor")
     */
    private $datas;


    public function __construct()
    {
        $this->stats = new ArrayCollection();
        $this->datas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDevice(): ?Devices
    {
        return $this->idDevice;
    }

    public function setIdDevice(Devices $idDevice): self
    {
        $this->idDevice = $idDevice;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return Collection|Stats[]
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    public function addStat(Stats $stat): self
    {
        if (!$this->stats->contains($stat)) {
            $this->stats[] = $stat;
            $stat->setSensor($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getSensor() === $this) {
                $stat->setSensor(null);
            }
        }

        return $this;
    }

    public function getStatType(): ?StatType
    {
        return $this->statType;
    }

    public function setStatType(?StatType $statType): self
    {
        $this->statType = $statType;

        return $this;
    }

    /**
     * @return Collection|Datas[]
     */
    public function getDatas(): Collection
    {
        return $this->datas;
    }

    public function addData(Datas $data): self
    {
        if (!$this->datas->contains($data)) {
            $this->datas[] = $data;
            $data->setSensor($this);
        }

        return $this;
    }

    public function removeData(Datas $data): self
    {
        if ($this->datas->contains($data)) {
            $this->datas->removeElement($data);
            // set the owning side to null (unless already changed)
            if ($data->getSensor() === $this) {
                $data->setSensor(null);
            }
        }

        return $this;
    }
}
