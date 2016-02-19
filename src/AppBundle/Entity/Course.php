<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 * @ORM\Table(name="courses"
 *  ,indexes={
 *      @ORM\Index(name="idx_name", columns={"name"}),
 *      @ORM\Index(name="idx_author", columns={"author"})
 *  }
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Course
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="course")
     */
    protected $lessons;

    public function __construct()
    {
        $this
            ->setCreatedAt(new \DateTime())
            ->setLessons(new ArrayCollection())
        ;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this
            ->setUpdatedAt(new \DateTime())
        ;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->onPrePersist();
    }

    /**
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param   int     $id
     *
     * @return  $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param   string  $name
     *
     * @return  $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return  string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param   string  $author
     *
     * @return  $this
     */
    public function setAuthor($author)
    {
        $this->author = (string) $author;

        return $this;
    }

    /**
     * @return  \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param   \DateTime   $createdAt
     *
     * @return  $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return  \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param   \DateTime   $updatedAt
     *
     * @return  $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return  ArrayCollection
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * @param   array|ArrayCollection   $lessons
     *
     * @return  $this
     */
    public function setLessons($lessons)
    {
        $this->lessons = $lessons;

        return $this;
    }
}