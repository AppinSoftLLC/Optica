<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CheckupItem
 *
 * @ORM\Table(name="checkup_item")
 * @ORM\Entity(repositoryClass="App\Repository\CheckupitemRepository")
 */
class CheckupItem
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
     * @ORM\Column(name="Title", type="string", length=255, nullable=false)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


}
