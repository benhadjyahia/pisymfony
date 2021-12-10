<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 * @Vich\Uploadable

 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     */
    private $Nom_Event;


    /**
     *
     * @Vich\UploadableField(mapping="event_images", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;


    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank
     */
    private $Adresse_Event;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\NotBlank
     */
    private $Num_Event;

    /**
     * @ORM\Column(type="date")
     *  @Assert\NotBlank
     */
    private $Date_Event;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryE::class, inversedBy="evenements")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvent(): ?string
    {
        return $this->Nom_Event;
    }

    public function setNomEvent(string $Nom_Event): self
    {
        $this->Nom_Event = $Nom_Event;

        return $this;
    }

    public function getAdresseEvent(): ?string
    {
        return $this->Adresse_Event;
    }

    public function setAdresseEvent(string $Adresse_Event): self
    {
        $this->Adresse_Event = $Adresse_Event;

        return $this;
    }

    public function getNumEvent(): ?int
    {
        return $this->Num_Event;
    }

    public function setNumEvent(int $Num_Event): self
    {
        $this->Num_Event = $Num_Event;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->Date_Event;
    }

    public function setDateEvent(\DateTimeInterface $Date_Event): self
    {
        $this->Date_Event = $Date_Event;

        return $this;
    }

    public function getCategory(): ?CategoryE
    {
        return $this->category;
    }

    public function setCategory(?CategoryE $category): self
    {
        $this->category = $category;

        return $this;
    }


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            //$this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

}
