<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Eleve::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $eleve;

    /**
     * @ORM\OneToOne(targetEntity=Evenement::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenementId(Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
