<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=ReservationService::class, mappedBy="service")
     */
    private $reservationServices;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->reservationServices = new ArrayCollection();
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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
    public function __toString()
    {
        return strval( $this->id);
    }

    /**
     * @return Collection|ReservationService[]
     */
    public function getReservationServices(): Collection
    {
        return $this->reservationServices;
    }

    public function addReservationService(ReservationService $reservationService): self
    {
        if (!$this->reservationServices->contains($reservationService)) {
            $this->reservationServices[] = $reservationService;
            $reservationService->setService($this);
        }

        return $this;
    }

    public function removeReservationService(ReservationService $reservationService): self
    {
        if ($this->reservationServices->removeElement($reservationService)) {
            // set the owning side to null (unless already changed)
            if ($reservationService->getService() === $this) {
                $reservationService->setService(null);
            }
        }

        return $this;
    }
}
