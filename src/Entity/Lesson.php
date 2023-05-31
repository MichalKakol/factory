<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Treining $training_id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(nullable: true)]
    private ?int $max_persons = null;

    #[ORM\OneToMany(mappedBy: 'person_id', targetEntity: Registration::class, orphanRemoval: true)]
    private Collection $registrations;

    #[ORM\ManyToOne(inversedBy: 'lesson')]
    private ?Person $instructor_id = null;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrainingId(): ?Treining
    {
        return $this->training_id;
    }

    public function setTrainingId(?Treining $training_id): self
    {
        $this->training_id = $training_id;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getMaxPersons(): ?string
    {
        return $this->max_persons;
    }

    public function setMaxPersons(?string $max_persons): self
    {
        $this->max_persons = $max_persons;

        return $this;
    }


    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setPersonId($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getPersonId() === $this) {
                $registration->setPersonId(null);
            }
        }

        return $this;
    }

    public function getInstructorId(): ?Person
    {
        return $this->instructor_id;
    }

    public function setInstructorId(?Person $instructor_id): self
    {
        $this->instructor_id = $instructor_id;

        return $this;
    }

}
