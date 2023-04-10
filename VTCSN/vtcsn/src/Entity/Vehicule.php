<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $typeVehicule = null;

    #[ORM\Column]
    private ?int $numberPlace = null;

    #[ORM\Column(length: 45)]
    private ?string $brand = null;

    #[ORM\Column(length: 45)]
    private ?string $model = null;

    #[ORM\Column(length: 45)]
    private ?string $color = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 45)]
    private ?string $energie = null;

    #[ORM\Column]
    private ?int $numberDoor = null;

    #[ORM\Column(length: 45,unique:true)]
    private ?string $licensePlate = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }
    #[ORM\OneToOne(mappedBy: 'vehicule', cascade: ['persist', 'remove'])]
    private ?Driver $driver = null;

    public function getTypeVehicule(): ?string
    {
        return $this->typeVehicule;
    }

    public function setTypeVehicule(string $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    public function getNumberPlace(): ?int
    {
        return $this->numberPlace;
    }

    public function setNumberPlace(int $numberPlace): self
    {
        $this->numberPlace = $numberPlace;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getNumberDoor(): ?int
    {
        return $this->numberDoor;
    }
    public function __toString()
    {
        return $this->getEnergie();
    }


    public function setNumberDoor(int $numberDoor): self
    {
        $this->numberDoor = $numberDoor;

        return $this;
    }

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): self
    {
        $this->licensePlate = $licensePlate;

        return $this;
    }

   
    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(Driver $driver): self
    {
        // set the owning side of the relation if necessary
        if ($driver->getVehicule() !== $this) {
            $driver->setVehicule($this);
        }

        $this->driver = $driver;

        return $this;
    }


   

   
}