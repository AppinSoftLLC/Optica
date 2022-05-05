<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Devices
 *
 * @ORM\Table(name="devices", indexes={@ORM\Index(name="devices_fk1", columns={"RoomID"}), @ORM\Index(name="devices_fk2", columns={"StatusID"})})
 * @ORM\Entity
 */
class Devices
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Serial", type="string", length=255, nullable=false)
     */
    private $serial;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=500, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Maker", type="string", length=255, nullable=false)
     */
    private $maker;

    /**
     * @var string
     *
     * @ORM\Column(name="Model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var int
     *
     * @ORM\Column(name="Produced", type="integer", nullable=false)
     */
    private $produced;

    /**
     * @var int
     *
     * @ORM\Column(name="Price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var \Rooms
     *
     * @ORM\ManyToOne(targetEntity="Rooms", inversedBy="devices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RoomID", referencedColumnName="ID")
     * })
     */
    private $roomid;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="StatusID", referencedColumnName="ID")
     * })
     */
    private $statusid;

    /**
     * @var \DevicesCheck
     * 
     * @ORM\OneToMany(targetEntity="DevicesCheck", mappedBy="deviceid")
     */
    private $devicescheck;

    public function __construct()
    {
        $this->devicescheck = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerial(): ?string
    {
        return $this->serial;
    }

    public function setSerial(string $serial): self
    {
        $this->serial = $serial;

        return $this;
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

    public function getMaker(): ?string
    {
        return $this->maker;
    }

    public function setMaker(string $maker): self
    {
        $this->maker = $maker;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getProduced(): ?int
    {
        return $this->produced;
    }

    public function setProduced(int $produced): self
    {
        $this->produced = $produced;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRoomid(): ?Rooms
    {
        return $this->roomid;
    }

    public function setRoomid(?Rooms $roomid): self
    {
        $this->roomid = $roomid;

        return $this;
    }

    public function getStatusid(): ?Status
    {
        return $this->statusid;
    }

    public function setStatusid(?Status $statusid): self
    {
        $this->statusid = $statusid;

        return $this;
    }

    public function addDevicescheck(DevicesCheck $devicescheck): self
    {
        if (!$this->devicescheck->contains($devicescheck)) {
            $this->devicescheck[] = $devicescheck;
            $devicescheck->setCheckitemid($this);
        }

        return $this;
    }

    public function removeDevicecheck(DevicesCheck $devicescheck): self
    {
        if ($this->devicescheck->removeElement($devicescheck)) {
            // set the owning side to null (unless already changed)
            if ($devicescheck->getCheckitemid() === $this) {
                $devicescheck->setCheckitemid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DevicesCheck[]
     */
    public function getDevicescheck(): Collection
    {
        return $this->devicescheck;
    }

    public function removeDevicescheck(DevicesCheck $devicescheck): self
    {
        if ($this->devicescheck->removeElement($devicescheck)) {
            // set the owning side to null (unless already changed)
            if ($devicescheck->getDeviceid() === $this) {
                $devicescheck->setDeviceid(null);
            }
        }

        return $this;
    }

}
