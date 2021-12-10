<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Cocur\Slugify\Slugify;



/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     */
    private $Nom_p;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     */
    private $Marque_p;


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Positive
     */
    private $Prix_p;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Positive
     */
    private $Quantite_p;


    /**
     * @ORM\ManyToOne(targetEntity=Category11::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
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
     * @return product
     */
    public function setImageFile(?File $imageFile):product
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
     * @return product
     */
    public function setFilename(?string $filename): product
    {
        $this->filename = $filename;
        return  $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomP(): ?string
    {
        return $this->Nom_p;
    }

    public function setNomP(string $Nom_p): self
    {
        $this->Nom_p = $Nom_p;

        return $this;
    }
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->Nom_p);
    }

    public function getMarqueP(): ?string
    {
        return $this->Marque_p;
    }

    public function setMarqueP(string $Marque_p): self
    {
        $this->Marque_p = $Marque_p;

        return $this;
    }

    public function getPrixP(): ?int
    {
        return $this->Prix_p;
    }

    public function setPrixP(int $Prix_p): self
    {
        $this->Prix_p = $Prix_p;

        return $this;
    }

    public function getQuantiteP(): ?int
    {
        return $this->Quantite_p;
    }

    public function setQuantiteP(int $Quantite_p): self
    {
        $this->Quantite_p = $Quantite_p;

        return $this;
    }

    public function getCategorie(): ?Category11
    {
        return $this->categorie;
    }

    public function setCategorie(?Category11 $categorie): self
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
