<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CheckupComment
 *
 * @ORM\Table(name="checkup_comment", indexes={@ORM\Index(name="checkup_comment_fk1", columns={"DeviceID"})})
 * @ORM\Entity(repositoryClass="App\Repository\CheckupCommentRepository")
 */
class CheckupComment
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
     * @var string|null
     *
     * @ORM\Column(name="Comments", type="text", length=65535, nullable=true)
     */
    private $comments;

    /**
     * @var \Devices
     *
     * @ORM\ManyToOne(targetEntity="Devices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DeviceID", referencedColumnName="ID")
     * })
     */
    private $deviceid;

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

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

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


}
