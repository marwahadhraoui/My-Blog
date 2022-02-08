<?php

namespace App\Entity;

use App\Repository\ReservationHotelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationHotelRepository::class)
 */
class ReservationHotel
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
    private $nom_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="reservationHotels")
     */
    private $chambre;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="reservationHotels")
     */
    private $checks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): self
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenom_client;
    }

    public function setPrenomClient(string $prenom_client): self
    {
        $this->prenom_client = $prenom_client;

        return $this;
    }

    public function getAdresseClient(): ?string
    {
        return $this->adresse_client;
    }

    public function setAdresseClient(string $adresse_client): self
    {
        $this->adresse_client = $adresse_client;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getChecks(): ?Reservation
    {
        return $this->checks;
    }

    public function setChecks(?Reservation $checks): self
    {
        $this->checks = $checks;

        return $this;
    }
}
