<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $person_id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lesson $lesson_id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $payment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLessonId(): ?Person
    {
        return $this->lesson_id;
    }

    public function setLessonId(?Person $lesson_id): self
    {
        $this->lesson_id = $lesson_id;

        return $this;
    }

    public function getPersonId(): ?Lesson
    {
        return $this->person_id;
    }

    public function setPersonId(?Lesson $person_id): self
    {
        $this->person_id = $person_id;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(?string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }
}
