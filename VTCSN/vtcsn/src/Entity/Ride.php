<?php

namespace App\Entity;

use App\Repository\RideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RideRepository::class)]
class Ride
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type:'boolean')]
    private  $status = false;

    #[ORM\Column(length: 255)]
    private  ?string $rendezVous = null;

    #[ORM\Column(length: 255)]
    private ?string $destination = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $rendezVousTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $timeDestination = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable: true)]
    private ?\DateTimeInterface $stopTime = null;

    #[ORM\Column(type:'boolean')]
    private  $canceled = false;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private  $created_at ;

    #[ORM\ManyToOne(inversedBy: 'rides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'rides')]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Driver::class, inversedBy: 'rides')]
    private Collection $driver;

   

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __construct()
    {
       
        $this->created_at = new \DateTimeImmutable();
        $this->user = new ArrayCollection();
        $this->driver = new ArrayCollection();
      
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRendezVous(): ?string
    {
        return $this->rendezVous;
    }

    public function setRendezVous(string $rendezVous): self
    {
        $this->rendezVous = $rendezVous;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getRendezVousTime(): ?\DateTimeInterface
    {
        return $this->rendezVousTime;
    }

    public function setRendezVousTime(\DateTimeInterface $rendezVousTime): self
    {
        $this->rendezVousTime = $rendezVousTime;

        return $this;
    }

    public function getTimeDestination(): ?\DateTimeInterface
    {
        return $this->timeDestination;
    }

    public function setTimeDestination(\DateTimeInterface $timeDestination): self
    {
        $this->timeDestination = $timeDestination;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getStopTime(): ?\DateTimeInterface
    {
        return $this->stopTime;
    }

    public function setStopTime(\DateTimeInterface $stopTime): self
    {
        $this->stopTime = $stopTime;

        return $this;
    }

    public function getCanceled(): ?string
    {
        return $this->canceled;
    }

    public function setCanceled(?string $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getLocation(): ?location
    {
        return $this->location;
    }

    public function setLocation(?location $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }
  

    public function addUser(user $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(user $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, driver>
     */
    public function getDriver(): Collection
    {
        return $this->driver;
    }

    public function addDriver(driver $driver): self
    {
        if (!$this->driver->contains($driver)) {
            $this->driver->add($driver);
        }

        return $this;
    }

    public function removeDriver(driver $driver): self
    {
        $this->driver->removeElement($driver);

        return $this;
    }

    
}