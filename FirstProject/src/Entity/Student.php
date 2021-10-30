<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     */
    private $nsc;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="students")
     */
    private $classroom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $enabled;

    /**
     * @ORM\Column(type="float")
     */
    private $moyenne;

    

    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    public function setNsc(string $nsc): self
    {
        $this->nsc = $nsc;

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

    public function getClassroom(): ?classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEnabled(): ?string
    {
        return $this->enabled;
    }

    public function setEnabled(?string $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }
}
