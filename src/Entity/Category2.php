<?php

namespace App\Entity;

use App\Repository\Category2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Category2Repository::class)
 */
class Category2
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
    private $labell1;

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="categorie")
     */
    private $exercices;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabell1(): ?string
    {
        return $this->labell1;
    }

    public function setLabell1(string $labell1): self
    {
        $this->labell1 = $labell1;

        return $this;
    }

    /**
     * @return Collection|Exercice[]
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): self
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices[] = $exercice;
            $exercice->setCategorie($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getCategorie() === $this) {
                $exercice->setCategorie(null);
            }
        }



        return $this;
    }
    public function __toString(){
        return $this->labell1;
    }
}
