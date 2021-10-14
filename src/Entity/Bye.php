<?php

namespace App\Entity;

use App\Repository\ByeRepository;
use App\Traits\TrackingTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ByeRepository::class)
 */
class Bye
{

    use TrackingTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ByeLikes::class, mappedBy="bye")
     */
    private $byeLikes;

    public function __construct()
    {
        $this->byeLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ByeLikes[]
     */
    public function getByeLikes(): Collection
    {
        return $this->byeLikes;
    }

    public function addByeLike(ByeLikes $byeLike): self
    {
        if (!$this->byeLikes->contains($byeLike)) {
            $this->byeLikes[] = $byeLike;
            $byeLike->setBye($this);
        }

        return $this;
    }

    public function removeByeLike(ByeLikes $byeLike): self
    {
        if ($this->byeLikes->removeElement($byeLike)) {
            // set the owning side to null (unless already changed)
            if ($byeLike->getBye() === $this) {
                $byeLike->setBye(null);
            }
        }

        return $this;
    }
}
