<?php

namespace AppBundle\Services;

use AppBundle\Exception\EmptyContentException;
use AppBundle\Helper\Criteria;
use Symfony\Component\Translation\Translator;

class CourseService
{
    /** @var  string */
    protected $storagePath;

    /** @var  Translator */
    protected $translator;

    public function __construct($storagePath, $coursesFile)
    {
        $this
            ->setStoragePath($storagePath, $coursesFile);
    }

    /**
     * @param   Translator $translator
     *
     * @return  $this
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * @param   string $storagePath
     * @param   string $coursesFile
     *
     * @return  $this
     */
    protected function setStoragePath($storagePath, $coursesFile)
    {
        $this->storagePath = sprintf('%s/%s', rtrim($storagePath, '/'), ltrim($coursesFile, '/'));

        return $this;
    }

    /**
     * @param   array   $criteria
     *
     * @return  array
     * @throws  EmptyContentException
     */
    public function findBy(array $criteria)
    {
        $keys = array_keys($criteria);
        if (
            count($keys) == 2 && (
            ($keys[0] == Criteria::LEVEL && $keys[1] == Criteria::ID) ||
            ($keys[1] == Criteria::LEVEL && $keys[0] == Criteria::ID))
        ) {
            return $this->getCourseByIdAndLevel($criteria[Criteria::ID], $criteria[Criteria::LEVEL]);
        } elseif (count($keys) == 1) {
            return $this->getCourseByLevel($criteria[Criteria::LEVEL]);
        }

        return $this->findAll();

    }

    /**
     * @return  array
     */
    protected function findAll()
    {
        return json_decode(file_get_contents($this->storagePath), true);
    }

    /**
     * Filter input courses data by level
     *
     * @param   int     $level
     *
     * @return  array
     * @throws  EmptyContentException
     */
    protected function getCourseByLevel ($level)
    {
        /**
         *  The courses.json file can change and so we fetch it on every method call
         */
        /** @var array $data */
        $data = $this->findAll();
        if (!count($data)) {
            throw new EmptyContentException($this->translator->trans('There are no results to match your criteria(level: %level%', array(
                '%level%'   => $level,
            )));
        }

        $filteredCourses = [];
        $hasAtLeastACourse = false;
        foreach ($data['courses'] as $key => $course) {
            if ($level == $course[Criteria::LEVEL]) {
                array_push($filteredCourses, $course);
                $hasAtLeastACourse = true;
            }
        }

        if (!$hasAtLeastACourse) {
            throw new EmptyContentException($this->translator->trans('There are no results to match your criteria(level: %level%', array(
                '%level%'   => $level,
            )));
        }

        return $filteredCourses;
    }

    /**
     * Return a course by level and id
     *
     * @param   int     $level
     * @param   int     $id
     *
     * @return  array
     * @throws  EmptyContentException
     */
    protected function getCourseByIdAndLevel ($id, $level)
    {
        /**
         *  The courses.json file can change and so we fetch it on every method call
         */
        /** @var array $data */
        $data = $this->findAll();
        if (!count($data)) {
            throw new EmptyContentException($this->translator->trans('There are no results to match your criteria( id: %id%, level: %level%', array(
                '%id%'      => $id,
                '%level%'   => $level,
            )));
        }

        $filteredCourses = [];
        $hasAtLeastACourse = false;
        foreach ($data['courses'] as $key => $course ) {
            if ($level == $course[Criteria::LEVEL] && $id == $course[Criteria::ID]) {
                array_push($filteredCourses, $course);
                $hasAtLeastACourse = true;
            }
        }

        if (!$hasAtLeastACourse) {
            throw new EmptyContentException($this->translator->trans('There are no results to match your criteria( id: %id%, level: %level%', array(
                '%id%'      => $id,
                '%level%'   => $level,
            )));
        }

        return $filteredCourses[0];
    }

    /**
     * @param   array   $data
     *
     * @return  string
     */
    public function createCourse ($data)
    {
        $creationData   = $data['data'];
        $courseAuthor   = $creationData['author'];
        $courseName     = $creationData['name'];
        $courseLevel    = $creationData['level'];
        $courseImage    = $creationData['imgSrc'];

        /**
         * Pass the data to a Doctrine handler or a repository for data insertion
         */

        return $this->translator->trans("The course insertion was successful");
    }
} 