<?php

namespace AppBundle\Doctrine\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Music\SecurityBundle\Entity\User;
use Music\SecurityBundle\Service\ApiKeyGeneratorService;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class LoadUserData extends AbstractLoad
{
    public function load(ObjectManager $manager)
    {
        /** @var PasswordEncoderInterface $encoder */
        $encoder = $this->get('security.password_encoder');
        /** @var ApiKeyGeneratorService $apiKeyGenerator */
        $apiKeyGenerator = $this->get('music.security.generator.api.key');

        $user = new User();
        $user
            ->setUsername('musicUser')
            ->setApiKey($apiKeyGenerator->generate())
        ;

        $password = $encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}