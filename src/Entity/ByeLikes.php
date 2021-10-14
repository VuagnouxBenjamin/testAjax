<?php

namespace App\Entity;

use App\Repository\ByeLikesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ByeLikesRepository::class)
 */
class ByeLikes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bye::class, inversedBy="byeLikes")
     */
    private $bye;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="byeLikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBye(): ?Bye
    {
        return $this->bye;
    }

    public function setBye(?Bye $bye): self
    {
        $this->bye = $bye;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
