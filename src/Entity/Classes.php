<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassesRepository::class)
 */
class Classes
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $section;

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


    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
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
