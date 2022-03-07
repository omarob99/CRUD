<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="text")
     */
    private $name;


    /**
     * @ORM\Column(type="text")
     */
    private $description;


    // /**
    //  * @ORM\Column(type="text")
    //  * @ORM\OneToOne(targetEntity="App\Entity\StudentsGrades")
    //  */
    // public $studentsgrades;


    /**
     * @ORM\Column(type="string")
     */
    private $date_created;


    /**
     * @ORM\Column(type="string")
     */
    private $date_modified;



    function __construct() {
        $this->date_created = date("d-m-Y");
      }

public function getDateCreated()
    {
        return $this->date_created;
    }

    public function getDateModified()
    {
        return $this->date_modified;
    }

    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;
    }

    public function setDateModified($date_modified)
    {
        $this->date_modified = $date_modified;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    // public function getStudentsgrades(): ?string
    // {
    //     return $this->studentsgrades;
    // }

    // public function setStudentsgrades(string $studentsgrades): self
    // {
    //     $this->studentsgrades = $studentsgrades;

    //     return $this;
    // }
}
