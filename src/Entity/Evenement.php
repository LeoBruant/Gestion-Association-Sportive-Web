<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
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
     * @ORM\Column(type="string", length=45)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_places;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vignette;

    /**
     * @ORM\OneToOne(targetEntity=Sport::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Sport_id;

    /**
     * @ORM\OneToOne(targetEntity=Type::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Type_id;

    /**
     * @ORM\OneToOne(targetEntity=Categorie::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categorie_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNombrePlaces(): ?int
    {
        return $this->nombre_places;
    }

    public function setNombrePlaces(int $nombre_places): self
    {
        $this->nombre_places = $nombre_places;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVignette(): ?string
    {
        return $this->vignette;
    }

    public function setVignette(string $vignette): self
    {
        $this->vignette = $vignette;

        return $this;
    }

    public function getSportId(): ?Sport
    {
        return $this->Sport_id;
    }

    public function setSportId(Sport $Sport_id): self
    {
        $this->Sport_id = $Sport_id;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->Type_id;
    }

    public function setTypeId(Type $Type_id): self
    {
        $this->Type_id = $Type_id;

        return $this;
    }

    public function getCategorieId(): ?Categorie
    {
        return $this->Categorie_id;
    }

    public function setCategorieId(Categorie $Categorie_id): self
    {
        $this->Categorie_id = $Categorie_id;

        return $this;
    }
}
