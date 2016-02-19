<?php

namespace AppBundle\Doctrine\DataFixtures\ORM;

use AppBundle\Entity\Course;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCourseData extends AbstractLoad
{
    public function load(ObjectManager $manager)
    {
        $courseGE = new Course();
        $courseGE
            ->setName('Guitare éléctrique')
            ->setAuthor('John Doe')
        ;
        $manager->persist($courseGE);

        $courseGA = new Course();
        $courseGA
            ->setName('Guitare acoustique')
            ->setAuthor('John Doe')
        ;
        $manager->persist($courseGA);

        $courseP = new Course();
        $courseP
            ->setName('Piano')
            ->setAuthor('Jane Doe')
        ;
        $manager->persist($courseP);


        $courseB = new Course();
        $courseB
            ->setName('Basse')
            ->setAuthor('James Smith')
        ;
        $manager->persist($courseB);


        $courseBAT = new Course();
        $courseBAT
            ->setName('Batterie')
            ->setAuthor('James Smith')
        ;
        $manager->persist($courseBAT);

        $courseC = new Course();
        $courseC
            ->setName('Chant')
            ->setAuthor('John Johnson')
        ;
        $manager->persist($courseC);


        $manager->flush();

        $this->addReference('course-guitare-electrique', $courseGE);
        $this->addReference('course-guitare-acoustique', $courseGA);
        $this->addReference('course-piano', $courseP);
        $this->addReference('course-basse', $courseB);
        $this->addReference('course-batterie', $courseBAT);
        $this->addReference('course-chant', $courseC);
    }

    public function getOrder()
    {
        return 2;
    }
}