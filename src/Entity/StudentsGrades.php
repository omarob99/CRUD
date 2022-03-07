<?php

namespace App\Entity;

use App\Repository\StudentsGradesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentsGradesRepository::class)
 * })
 */
class StudentsGrades
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string")      
     */
    private $course;



    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="studentsgrades")
     */
    private $target_student;



    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\OneToOne(targetEntity="App\Entity\Classes")
     */
    private $class;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade;



   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?string
    {
        return $this->student;
    }

    public function setStudent(string $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course)//: self
    {
        $this->course = $course;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getClasses(): ?string
    {
        return $this->classes;
    }

    public function setClasses(string $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getTarget(): ?Student
    {
        return $this->target;
    }

    public function setTarget(?Student $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getTargetStudent(): ?Student
    {
        return $this->target_student;
    }

    public function setTargetStudent(?Student $target_student): self
    {
        $this->target_student = $target_student;

        return $this;
    }

    
}
