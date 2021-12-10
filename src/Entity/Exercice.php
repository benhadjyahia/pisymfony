<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * Exercice
 *
 * @ORM\Table(name="exercice")
 * @ORM\Entity
 * @Vich\Uploadable()
 */
class Exercice
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Ex", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEx;


    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Ex", type="string", length=255, nullable=false)
     */
    private $nomEx;


    /**
     * @var int
     *
     * @ORM\Column(name="Num_Ser", type="integer", nullable=false)
     * @Assert\Positive
     */
    private $numSer;

    /**
     * @var int
     *
     * @ORM\Column(name="Num_Rep", type="integer", nullable=false)
     * @Assert\Positive
     */
    private $numRep;

    /**
     * @ORM\ManyToOne(targetEntity=Category2::class, inversedBy="exercices")
     */
    private $categorie;



    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="filename")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;



    /**
     * @param null|File $imageFile
     * @return exercice
     */
    public function setImageFile(?File $imageFile):exercice
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return exercice
     */
    public function setFilename(?string $filename): exercice
    {
        $this->filename = $filename;
        return  $this;
    }


    /**
     * @return int
     */
    public function getIdEx(): ?int
    {
        return $this->idEx;
    }

    /**
     * @param int $idEx
     */
    public function setIdEx(int $idEx): void
    {
        $this->idEx = $idEx;
    }

    /**
     * @return string
     */
    public function getNomEx(): ?string
    {
        return $this->nomEx;
    }

    /**
     * @param string $nomEx
     */
    public function setNomEx(string $nomEx): void
    {
        $this->nomEx = $nomEx;
    }

    /**
     * @return int
     */
    public function getNumSer(): ?int
    {
        return $this->numSer;
    }

    /**
     * @param int $numSer
     */
    public function setNumSer(int $numSer): void
    {
        $this->numSer = $numSer;
    }

    /**
     * @return int
     */
    public function getNumRep(): ?int
    {
        return $this->numRep;
    }

    /**
     * @param int $numRep
     */
    public function setNumRep(int $numRep): void
    {
        $this->numRep = $numRep;
    }

    public function getCategorie(): ?Category2
    {
        return $this->categorie;
    }

    public function setCategorie(?Category2 $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


}
