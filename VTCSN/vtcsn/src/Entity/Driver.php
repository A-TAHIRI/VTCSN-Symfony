<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DriverRepository::class)]
class Driver
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100 )]
    private ?string $license = null;

    #[ORM\Column(type:'boolean')]
    private  $disponibility = false;

    #[ORM\Column(nullable: true)]
    private ?int $totalRide = null;

    #[ORM\OneToOne(inversedBy: 'driver', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicule $vehicule = null;

    #[ORM\ManyToOne(inversedBy: 'drivers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'driver', targetEntity: Rating::class)]
    private Collection $ratings;

    #[ORM\ManyToMany(targetEntity: Ride::class, mappedBy: 'driver')]
    private Collection $rides;

   
  
    public function __construct()
    {
        $this->ratings = new ArrayCollection();
        $this->rides = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getDisponibility();
    }

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getDisponibility(): ?string
    {
        return $this->disponibility;
    }

    public function setDisponibility(?string $disponibility): self
    {
        $this->disponibility = $disponibility;

        return $this;
    }
    public function getTotalRide(): ?int
    {
        return $this->totalRide;
    }

    public function setTotalRide(?int $totalRide): self
    {
        $this->totalRide = $totalRide;

        return $this;
    }

  

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setDriver($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getDriver() === $this) {
                $rating->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ride>
     */
    public function getRides(): Collection
    {
        return $this->rides;
    }

    public function addRide(Ride $ride): self
    {
        if (!$this->rides->contains($ride)) {
            $this->rides->add($ride);
            $ride->addDriver($this);
        }

        return $this;
    }

    public function removeRide(Ride $ride): self
    {
        if ($this->rides->removeElement($ride)) {
            $ride->removeDriver($this);
        }

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }
  
  

    
  

   
}