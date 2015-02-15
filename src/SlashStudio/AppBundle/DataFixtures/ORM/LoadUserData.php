<?php

namespace Network\StoreBundle\Entity;
namespace Network\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $manager;
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        return $this;
    }

    private function addUser($username, $password, $firstName, $email, $group)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        // $encoder = $this->container
        //                 ->get('security.encoder_factory')
        //                 ->getEncoder($user);

        $user->setUsername($username)
             ->setPlainPassword($password)
             ->setGender('male')
             ->setFirstName($firstName)
             ->setEmail($email)
             ->setEnabled(true)
             ->addGroup($group);

        $userManager->updateUser($user, true);
        $this->manager->persist($user);
        $this->manager->flush();
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $groupManager = $this->container->get('fos_user.group_manager');

        $groupAdmin = $groupManager->createGroup('admin');
        $groupAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $groupManager->updateGroup($groupAdmin, true);

        $this->addUser('admin', 'admin', 'Админ', 'some@example.com', $groupManager->findGroupByName('admin'));
    }
}
