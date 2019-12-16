<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoitureRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Voiture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="La marque doit faire plus de 3 caractères",maxMessage="Le titre ne peut pas faire plus de 255 caractères")
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le modèle doit faire plus de 3 caractères",maxMessage="Le titre ne peut pas faire plus de 255 caractères")
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     *   
     */
    private $coverImg;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $km;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\PositiveOrZero
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $proprio;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $cylindre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     * 
     */
    private $puissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="Puissance doit  faire plus de 5 caractères")
     */
    private $carburant;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     * 
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="Transmission doit  faire plus de 5 caractères")
     * 
     */
    private $transmission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="Description doit  faire plus de 5 caractères")
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=20, minMessage="Les options doivent faire plus de 20 caractères")
     */
    private $voption;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="voiture", orphanRemoval=true)
     * 
     */
    private $images;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=50, minMessage="Votre description doit faire plus de 50 caractères")
     */
    private $descrip;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCoverImg(): ?string
    {
        return $this->coverImg;
    }

    public function setCoverImg(string $coverImg): self
    {
        $this->coverImg = $coverImg;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getProprio(): ?int
    {
        return $this->proprio;
    }

    public function setProprio(int $proprio): self
    {
        $this->proprio = $proprio;

        return $this;
    }

    public function getCylindre(): ?int
    {
        return $this->cylindre;
    }

    public function setCylindre(int $cylindre): self
    {
        $this->cylindre = $cylindre;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

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

    public function getVoption(): ?string
    {
        return $this->voption;
    }

    public function setVoption(string $voption): self
    {
        $this->voption = $voption;

        return $this;
    }

    /**
     * Permet d'intialiser le slug
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initializeSlug(){
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->modele);
        }
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVoiture($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getVoiture() === $this) {
                $image->setVoiture(null);
            }
        }

        return $this;
    }

    public function getDescrip(): ?string
    {
        return $this->descrip;
    }

    public function setDescrip(string $descrip): self
    {
        $this->descrip = $descrip;

        return $this;
    }
}