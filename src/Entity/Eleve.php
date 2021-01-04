<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Categorie::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=45)
     */
	private $prenom;
	
	/**
     * @ORM\Column(type="string", length=45)
     */
	private $email;
	
	/**
     * @ORM\Column(type="string", length=45)
     */
    private $classe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
	}
	
	public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
	}
	
	public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
