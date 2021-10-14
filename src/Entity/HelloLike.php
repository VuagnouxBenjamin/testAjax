<?php

namespace App\Entity;

use App\Repository\HelloLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HelloLikeRepository::class)
 */
class HelloLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Hello::class, inversedBy="likes")
     */
    private $hello;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="likes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHello(): ?Hello
    {
        return $this->hello;
    }

    public function setHello(?Hello $hello): self
    {
        $this->hello = $hello;

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
