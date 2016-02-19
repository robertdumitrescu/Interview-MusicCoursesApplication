<?php

namespace AppBundle\Services;

use AppBundle\Entity\Lesson;
use AppBundle\Exception\EmptyContentException;
use AppBundle\Helper\Criteria;
use AppBundle\Repository\LessonRepository;
use Symfony\Component\Translation\Translator;

class CourseService
{
    /** @var  Translator */
    protected $translator;

    /** @var  LessonRepository */
    protected $lessonRepository;

    public function __construct($translator, $repository)
    {
        $this
            ->setTranslator($translator)
            ->setLessonRepository($repository)
        ;
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
     * @param   LessonRepository    $repository
     *
     * @return  $this
     */
    public function setLessonRepository($repository)
    {
        $this->lessonRepository = $repository;

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
        $lessons = $this->lessonRepository->findBy($criteria);

        if (!empty($lessons)) {
            return $this->translateLessons($lessons);
        }

        if (empty($criteria)) {
            throw new EmptyContentException($this->translator->trans('There are no courses!'));
        }
        $criteriaKeys = array_keys($criteria);

        $criteriaString = array_map(function($key) {
            return sprintf('%s : %%%s%%', $key, $key);
        }, $criteriaKeys);

        $criteriaMapValues = array_map(function($key, $item) {
            return [sprintf('%%%s%%', $key) => $item];
        }, $criteriaKeys, array_values($criteria));
        $criteriaValues = [];
        foreach ($criteriaMapValues as $value) {
            $criteriaValues[key($value)] = current($value);
        }

        throw new EmptyContentException($this->translator->trans(sprintf('There are no results to match your criteria(%s)', implode(', ', $criteriaString)), $criteriaValues));
    }

    public function translateLessons(array $lessons)
    {
        $built = [];
        /** @var Lesson $lesson */
        foreach ($lessons as $lesson) {
            $built[] = [
                'id'    => $lesson->getId(),
                'name' => $lesson->getName(),
                'level' => $lesson->getLevel(),
                'author' => $lesson->getCourse()->getAuthor(),
                'imgSrc' => $lesson->getImagePath(),
            ];
        }

        return $built;
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