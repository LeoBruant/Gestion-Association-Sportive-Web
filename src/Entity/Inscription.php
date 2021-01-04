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
    private $Eleve_id;

    /**
     * @ORM\OneToOne(targetEntity=Evenement::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Evenement_id;

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

    public function getEleveId(): ?Eleve
    {
        return $this->Eleve_id;
    }

    public function setEleveId(Eleve $Eleve_id): self
    {
        $this->Eleve_id = $Eleve_id;

        return $this;
    }

    public function getEvenementId(): ?Evenement
    {
        return $this->Evenement_id;
    }

    public function setEvenementId(Evenement $Evenement_id): self
    {
        $this->Evenement_id = $Evenement_id;

        return $this;
    }
}
