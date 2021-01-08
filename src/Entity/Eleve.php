<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface as UserInterface;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il existe déjà un compte avec cet adresse email")
 */
class Eleve implements UserInterface
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
    private $email;

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
     * @ORM\OneToOne(targetEntity=Classe::class, cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=false)
     */
	private $classe;
	
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $genre;

	/**
     * @ORM\Column(type="datetime", length=255)
     */
	private $dateCreation;

	/**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
	private $archivee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->id;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): self
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

	public function getGenre(): ?string
             {
                 return $this->genre;
             }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
	}

	public function getDateCreation(): ?DateTime
             {
                 return $this->dateCreation;
             }

    public function setDateCreation(DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
	}

	public function getArchivee(): ?bool
             {
                 return $this->archivee;
             }

    public function setArchivee(bool $archivee): self
    {
        $this->archivee = $archivee;

        return $this;
	}
	
    public function eraseCredentials()
    {

    }

    public function getSalt()
    {

    }

    public function getUsername()
    {

    }

    public function getRoles()
    {

    }
    public function getPassword()
    {

    }

    public function getTest(): ?Categorie
    {
        return $this->test;
    }

    public function setTest(Categorie $test): self
    {
        $this->test = $test;

        return $this;
    }
}
