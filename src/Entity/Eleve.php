<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface as UserInterface;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
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
     * @ORM\Column(type="integer")
     */
    private $CategorieId = 1;

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
     * @ORM\Column(type="string", length=255)
     */
	private $classeId;
	
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $genre;

	/**
     * @ORM\Column(type="datetime", length=255)
     */
	private $dateCreation;

	/**
     * @ORM\Column(type="boolean")
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

    public function getClasseId(): ?string
    {
        return $this->classeId;
    }

    public function setClasseId(string $classeId): self
    {
        $this->classeId = $classeId;

        return $this;
    }

    public function getCategorieId(): ?int
    {
        return $this->CategorieId;
    }

    public function setCategorieId(int $CategorieId): self
    {
        $this->CategorieId = $CategorieId;

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
}
