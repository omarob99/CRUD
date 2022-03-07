<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
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
    private $firstname;


    /**
     * @ORM\Column(type="text")
     */
    private $lastname;

    /**
     * @ORM\Column(type="text")
     */
    private $dob;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $img;

    // /**
    //  * @ORM\Column(type="text")
    //  */
    // private $courses;

    /////////////////////////////////////////
    /**
    *  @ORM\OneToMany(targetEntity="StudentsGrades",mappedBy="target_student") 
    */
    private $studentsgrades;



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
        $this->studentsgrades = new ArrayCollection();
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
    /////////////////////////////////////////

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFName()
    {
        return $this->firstname;
    }

    public function setFName($fname)
    {
        $this->firstname = $fname;
    }

    public function getLName()
    {
        return $this->lastname;
    }


    public function setLName($lname)
    {
        $this->lastname = $lname;
    }

    public function getDOB()
    {
        return $this->dob;
    }

    public function setDOB($dob)
    {
        $this->dob = $dob;
    }

    public function getIMG()
    {
        return $this->img;
    }

    public function setIMG($img)
    {
        $this->img = $img;
    }


    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, StudentsGrades>
     */
    public function getStudentsgrades(): Collection
    {
        return $this->studentsgrades;
    }

    public function addStudentsgrade(StudentsGrades $studentsgrade): self
    {
        if (!$this->studentsgrades->contains($studentsgrade)) {
            $this->studentsgrades[] = $studentsgrade;
            $studentsgrade->setTarget($this);
        }

        return $this;
    }

    public function removeStudentsgrade(StudentsGrades $studentsgrade): self
    {
        if ($this->studentsgrades->removeElement($studentsgrade)) {
            // set the owning side to null (unless already changed)
            if ($studentsgrade->getTarget() === $this) {
                $studentsgrade->setTarget(null);
            }
        }

        return $this;
    }


    
}
