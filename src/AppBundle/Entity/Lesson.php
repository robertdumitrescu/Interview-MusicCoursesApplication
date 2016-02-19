<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 * @ORM\Table(name="lessons"
 *  ,indexes={
 *      @ORM\Index(name="idx_level", columns={"level"}),
 *      @ORM\Index(name="idx_name", columns={"name"})
 *  }
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Lesson
{
    const LEVEL_BEGINNER = 1;
    const LEVEL_INTERMEDIATE = 2;
    const LEVEL_ADVANCED = 3;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Course
     *
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="lessons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $course;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="image_path", length=255, nullable=true)
     */
    protected $imagePath;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":1})
     */
    protected $level;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    protected $hits;

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

    public function __construct()
    {
        $this
            ->setCreatedAt(new \DateTime())
            ->setHits(0)
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
     * @return  Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param   Course  $course
     *
     * @return  $this
     */
    public function setCourse($course)
    {
        $this->course = $course;

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
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param   string  $level
     *
     * @return  $this
     */
    public function setLevel($level)
    {
        $this->level = $level;

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
     * @return  string
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param   string  $hits
     *
     * @return  $this
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * @return  string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param   string  $imagePath
     *
     * @return  $this
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}