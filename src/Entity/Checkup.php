<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checkup
 *
 * @ORM\Table(name="checkup", indexes={@ORM\Index(name="checkup_fk1", columns={"DeviceID"}), @ORM\Index(name="checkup_fk2", columns={"CheckupItemID"})})
 * @ORM\Entity(repositoryClass="App\Repository\CheckupRepository")
 */
class Checkup
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
     * @var \DateTime
     *
     * @ORM\Column(name="Dates", type="datetime", nullable=false)
     */
    private $dates;

    /**
     * @var bool
     *
     * @ORM\Column(name="State", type="boolean", nullable=false)
     */
    private $state;

    /**
     * @var \Devices
     *
     * @ORM\ManyToOne(targetEntity="Devices")
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
     *   @ORM\JoinColumn(name="CheckupItemID", referencedColumnName="ID")
     * })
     */
    private $checkupitemid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDates(): ?\DateTimeInterface
    {
        return $this->dates;
    }

    public function setDates(\DateTimeInterface $dates): self
    {
        $this->dates = $dates;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
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

    public function getCheckupitemid(): ?CheckupItem
    {
        return $this->checkupitemid;
    }

    public function setCheckupitemid(?CheckupItem $checkupitemid): self
    {
        $this->checkupitemid = $checkupitemid;

        return $this;
    }


}
