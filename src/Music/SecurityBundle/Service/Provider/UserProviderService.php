<?php

namespace Music\SecurityBundle\Service\Provider;

use Music\SecurityBundle\Entity\User;
use Music\SecurityBundle\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Translation\Translator;

class UserProviderService implements UserProviderInterface
{
    /** @var  Translator */
    protected $translator;

    /** @var  UserRepository */
    protected $userRepository;

    /** @var  string */
    protected $supportedClass;

    /**
     * @param   UserRepository  $userRepository
     */
    public function setUserRepository($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param   string  $supportedClass
     */
    public function setSupportedClass($supportedClass)
    {
        $this->supportedClass = $supportedClass;
    }

    /**
     * @param Translator $translator
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        $user = $this->userRepository->findOneBy(['username' => $username]);

        if (!$user) {
            throw new UsernameNotFoundException($this->translator->trans('Username %username% does not exist!', ['%username%' => $username,]));
        }

        return $user;
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user))) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        /** @var $user User */

        return $this->userRepository->find($user->getId());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $this->supportedClass === $class || is_subclass_of($class, $this->supportedClass);
    }
}