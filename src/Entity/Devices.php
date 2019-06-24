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
     * @ORM\ManyToMany(targetEntity="App\Entity\Users", inversedBy="devices")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sensor", mappedBy="devices")
     */
    private $sensor;

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    public function addUser(Users $users){
        $this->users[] = $users;
        return $this;
    }

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

    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    public function setSensor(Sensor $sensor): self
    {
        $this->sensor = $sensor;

        // set the owning side of the relation if necessary
        if ($this !== $sensor->getIdDevice()) {
            $sensor->setIdDevice($this);
        }

        return $this;
    }
}
