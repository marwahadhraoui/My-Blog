<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     *  @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_etoiles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_nuitee;

    /**
     * @ORM\OneToMany(targetEntity=ReservationHotel::class, mappedBy="hotel")
     */
    private $reservationHotels;

    public function __construct()
    {
        $this->reservationHotels = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getNbEtoiles(): ?int
    {
        return $this->nb_etoiles;
    }

    public function setNbEtoiles(int $nb_etoiles): self
    {
        $this->nb_etoiles = $nb_etoiles;

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

    public function getPrixNuitee(): ?int
    {
        return $this->prix_nuitee;
    }

    public function setPrixNuitee(int $prix_nuitee): self
    {
        $this->prix_nuitee = $prix_nuitee;

        return $this;
    }

    /**
     * @return Collection|ReservationHotel[]
     */
    public function getReservationHotels(): Collection
    {
        return $this->reservationHotels;
    }

    public function addReservationHotel(ReservationHotel $reservationHotel): self
    {
        if (!$this->reservationHotels->contains($reservationHotel)) {
            $this->reservationHotels[] = $reservationHotel;
            $reservationHotel->setHotel($this);
        }

        return $this;
    }

    public function removeReservationHotel(ReservationHotel $reservationHotel): self
    {
        if ($this->reservationHotels->removeElement($reservationHotel)) {
            // set the owning side to null (unless already changed)
            if ($reservationHotel->getHotel() === $this) {
                $reservationHotel->setHotel(null);
            }
        }

        return $this;
    }
    function __toString()
    {
        return strval($this->id);
    }
}
