<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevicesRepository")
 */
class Devices
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
    private $uid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sensors", mappedBy="devices")
     */
    private $sensor;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSensor(): ?Sensors
    {
        return $this->sensor;
    }

    public function setSensor(Sensors $sensor): self
    {
        $this->sensor = $sensor;

        // set the owning side of the relation if necessary
        if ($this !== $sensor->getIdDevice()) {
            $sensor->setIdDevice($this);
        }

        return $this;
    }
}
