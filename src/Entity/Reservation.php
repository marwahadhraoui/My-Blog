<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $check_in;

    /**
     * @ORM\Column(type="date")
     */
    private $check_out;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="reservations")
     */
    private $room;

    /**
     * @ORM\Column(type="integer")
     */
    private $adult;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity=ReservationHotel::class, mappedBy="checks")
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

    public function getCheckIn(): ?\DateTimeInterface
    {
        return $this->check_in;
    }

    public function setCheckIn(\DateTimeInterface $check_in): self
    {
        $this->check_in = $check_in;

        return $this;
    }

    public function getCheckOut(): ?\DateTimeInterface
    {
        return $this->check_out;
    }

    public function setCheckOut(\DateTimeInterface $check_out): self
    {
        $this->check_out = $check_out;

        return $this;
    }

    public function getRoom(): ?Chambre
    {
        return $this->room;
    }

    public function setRoom(?Chambre $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getAdult(): ?int
    {
        return $this->adult;
    }

    public function setAdult(int $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getChildren(): ?int
    {
        return $this->children;
    }

    public function setChildren(?int $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function __toString()
    {
        return strval( $this->id) ;
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
            $reservationHotel->setChecks($this);
        }

        return $this;
    }

    public function removeReservationHotel(ReservationHotel $reservationHotel): self
    {
        if ($this->reservationHotels->removeElement($reservationHotel)) {
            // set the owning side to null (unless already changed)
            if ($reservationHotel->getChecks() === $this) {
                $reservationHotel->setChecks(null);
            }
        }

        return $this;
    }
}
