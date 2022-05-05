<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DevicesCheck
 *
 * @ORM\Table(name="devices_check", indexes={@ORM\Index(name="devices_check_fk2", columns={"CheckitemID"}), @ORM\Index(name="devices_check_fk1", columns={"DeviceID"})})
 * @ORM\Entity(repositoryClass="App\Repository\DeviceCheckRepository")
 */
class DevicesCheck
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
     * @var \Devices
     *
     * @ORM\ManyToOne(targetEntity="Devices", inversedBy="devicescheck")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DeviceID", referencedColumnName="ID")
     * })
     */
    private $deviceid;

    /**
     * @var \CheckupItem
     *
     * @ORM\ManyToOne(targetEntity="CheckupItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CheckitemID", referencedColumnName="ID")
     * })
     */
    private $checkitemid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceid(): ?Devices
    {
        return $this->deviceid;
    }

    public function setDeviceid(?Devices $deviceid): self
    {
        $this->deviceid = $deviceid;

        return $this;
    }

    public function getCheckitemid(): ?CheckupItem
    {
        return $this->checkitemid;
    }

    public function setCheckitemid(?CheckupItem $checkitemid): self
    {
        $this->checkitemid = $checkitemid;

        return $this;
    }


}
