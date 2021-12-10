<?php

namespace App\Entity;

use App\Repository\ProudctSearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProudctSearchRepository::class)
 */
class ProductSearch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxprice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxprice(): ?int
    {
        return $this->maxprice;
    }

    public function setMaxprice(int $maxprice): self
    {
        $this->maxprice = $maxprice;

        return $this;
    }
}
