<?php

namespace App\Entity;

use App\Repository\CategoryCRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryCRepository::class)
 */
class CategoryC
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Type("string")
     */
    private $labell;

    /**
     * @ORM\OneToMany(targetEntity=Planning::class, mappedBy="categoryC")
     */
    private $plannings;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    public function __construct()
    {
        $this->plannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabell(): ?string
    {
        return $this->labell;
    }

    public function setLabell(string $labell): self
    {
        $this->labell = $labell;

        return $this;
    }

    /**
     * @return Collection|Planning[]
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->setCategory($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getCategory() === $this) {
                $planning->setCategory(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->labell;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }


}
