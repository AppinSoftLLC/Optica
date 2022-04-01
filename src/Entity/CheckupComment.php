<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CheckupComment
 *
 * @ORM\Table(name="checkup_comment", indexes={@ORM\Index(name="checkup_comment_fk1", columns={"CheckupID"})})
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
     * @var string|null
     *
     * @ORM\Column(name="Comments", type="text", length=65535, nullable=true)
     */
    private $comments;

    /**
     * @var \Checkup
     *
     * @ORM\ManyToOne(targetEntity="Checkup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CheckupID", referencedColumnName="ID")
     * })
     */
    private $checkupid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCheckupid(): ?Checkup
    {
        return $this->checkupid;
    }

    public function setCheckupid(?Checkup $checkupid): self
    {
        $this->checkupid = $checkupid;

        return $this;
    }


}
