<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SalleSport::class, mappedBy="category")
     */
    private $SallesSports;

    public function __construct()
    {
        $this->SallesSports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|SalleSport[]
     */
    public function getSallesSports(): Collection
    {
        return $this->SallesSports;
    }

    public function addSallesSport(SalleSport $sallesSport): self
    {
        if (!$this->SallesSports->contains($sallesSport)) {
            $this->SallesSports[] = $sallesSport;
            $sallesSport->setCategory($this);
        }

        return $this;
    }

    public function removeSallesSport(SalleSport $sallesSport): self
    {
        if ($this->SallesSports->removeElement($sallesSport)) {
            // set the owning side to null (unless already changed)
            if ($sallesSport->getCategory() === $this) {
                $sallesSport->setCategory(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->titre;
    }
}
