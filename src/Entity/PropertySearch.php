<?php

namespace App\Entity;

use App\Repository\PropertySearchRepository;
use Doctrine\ORM\Mapping as ORM;



class PropertySearch
{




    private $nomSalle;



    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    public function setNomSalle(string $nomSalle): self
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }
}
