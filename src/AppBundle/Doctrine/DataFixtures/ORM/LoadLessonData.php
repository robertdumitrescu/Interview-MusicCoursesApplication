<?php

namespace AppBundle\Doctrine\DataFixtures\ORM;

use AppBundle\Entity\Lesson;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLessonData extends AbstractLoad
{
    public function load(ObjectManager $manager)
    {
        $lessonConfigurator = $this->configureLessons();

        foreach ($lessonConfigurator as $configuration) {
            $lesson = new Lesson();
            $lesson
                ->setName($configuration['name'])
                ->setCourse($this->getReference($configuration['course']))
                ->setImagePath($configuration['image'])
                ->setLevel($configuration['level'])
            ;
            $manager->persist($lesson);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

    /**
     * @return  array
     */
    private function configureLessons()
    {
        return [
            [
                'name' => 'Guitare éléctrique',
                'course' => 'course-guitare-electrique',
                'image' => '/bundles/app/images/iStock_000008328172Small.png',
                'level' => Lesson::LEVEL_BEGINNER,
            ],
            [
                'name' => 'Guitare acoustique',
                'course' => 'course-guitare-acoustique',
                'image' => '/bundles/app/images/iStock_000013495257Small.png',
                'level' => Lesson::LEVEL_BEGINNER,
            ],
            [
                'name' => 'Piano',
                'course' => 'course-piano',
                'image' => '/bundles/app/images/piano-349928_1280.png',
                'level' => Lesson::LEVEL_BEGINNER,
            ],
            [
                'name' => 'Basse',
                'course' => 'course-basse',
                'image' => '/bundles/app/images/iStock_000028502006Small.png',
                'level' => Lesson::LEVEL_BEGINNER,
            ],
            [
                'name' => 'Batterie',
                'course' => 'course-batterie',
                'image' => '/bundles/app/images/iStock_000001510092Small.png',
                'level' => Lesson::LEVEL_BEGINNER,
            ],
            [
                'name' => 'Chant',
                'course' => 'course-chant',
                'image' => '/bundles/app/images/iStock_000028303656Small.png',
                'level' => Lesson::LEVEL_BEGINNER,
            ],
            [
                'name' => 'Guitare éléctrique',
                'course' => 'course-guitare-electrique',
                'image' => '/bundles/app/images/iStock_000008328172Small.png',
                'level' => Lesson::LEVEL_INTERMEDIATE,
            ],
            [
                'name' => 'Guitare acoustique',
                'course' => 'course-guitare-acoustique',
                'image' => '/bundles/app/images/iStock_000013495257Small.png',
                'level' => Lesson::LEVEL_INTERMEDIATE,
            ],
            [
                'name' => 'Piano',
                'course' => 'course-piano',
                'image' => '/bundles/app/images/piano-349928_1280.png',
                'level' => Lesson::LEVEL_INTERMEDIATE,
            ],
            [
                'name' => 'Basse',
                'course' => 'course-basse',
                'image' => '/bundles/app/images/iStock_000028502006Small.png',
                'level' => Lesson::LEVEL_INTERMEDIATE,
            ],
            [
                'name' => 'Batterie',
                'course' => 'course-batterie',
                'image' => '/bundles/app/images/iStock_000001510092Small.png',
                'level' => Lesson::LEVEL_INTERMEDIATE,
            ],
            [
                'name' => 'Chant',
                'course' => 'course-chant',
                'image' => '/bundles/app/images/iStock_000028303656Small.png',
                'level' => Lesson::LEVEL_INTERMEDIATE,
            ],
            [
                'name' => 'Guitare éléctrique',
                'course' => 'course-guitare-electrique',
                'image' => '/bundles/app/images/iStock_000008328172Small.png',
                'level' => Lesson::LEVEL_ADVANCED,
            ],
            [
                'name' => 'Guitare acoustique',
                'course' => 'course-guitare-acoustique',
                'image' => '/bundles/app/images/iStock_000013495257Small.png',
                'level' => Lesson::LEVEL_ADVANCED,
            ],
            [
                'name' => 'Piano',
                'course' => 'course-piano',
                'image' => '/bundles/app/images/piano-349928_1280.png',
                'level' => Lesson::LEVEL_ADVANCED,
            ],
            [
                'name' => 'Basse',
                'course' => 'course-basse',
                'image' => '/bundles/app/images/iStock_000028502006Small.png',
                'level' => Lesson::LEVEL_ADVANCED,
            ],
            [
                'name' => 'Batterie',
                'course' => 'course-batterie',
                'image' => '/bundles/app/images/iStock_000001510092Small.png',
                'level' => Lesson::LEVEL_ADVANCED,
            ],
            [
                'name' => 'Chant',
                'course' => 'course-chant',
                'image' => '/bundles/app/images/iStock_000028303656Small.png',
                'level' => Lesson::LEVEL_ADVANCED,
            ],
        ];
    }
}