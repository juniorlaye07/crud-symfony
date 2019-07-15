<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployerRepository")
 */
class Employer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Unique
     */
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire!")
     */
    private $Nom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Champ Obligatoire!")
     */
    private $Datenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ Obligatoire!")
     */
    private $Salaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="employers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->Matricule;
    }

    public function setMatricule(string $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->Datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $Datenaissance): self
    {
        $this->Datenaissance = $Datenaissance;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->Salaire;
    }

    public function setSalaire(string $Salaire): self
    {
        $this->Salaire = $Salaire;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }
}
