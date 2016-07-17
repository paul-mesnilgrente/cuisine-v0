<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function addUser(ObjectManager $manager, $email, $username, $password, $roles, $reference) {
        $encoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setEmail($email);
        $user->setEnabled(1);
        $user->setUsername($username);
        $password = $encoder->encodePassword($user, $password);
        $user->setPassword($password);
        $user->setRoles($roles);
        
        $manager->persist($user);
        $manager->flush();

        $this->addReference($reference, $user);
    }

    public function load(ObjectManager $manager)
    {
        $this->addUser($manager,
            'paul.mesnilgrente@gmail.com',
            'Paul Mesnilgrente',
            'lB7Xq9WdOxCz7Xzod1FH',
            array('ROLE_SUPER_ADMIN'),
            'user-admin');

        $this->addUser($manager,
            'karol-anne.pelosato@hotmail.fr',
            'Karol-anne Pelosato',
            '2pMJVtuDtwkctwtf3fLQ',
            array('ROLE_USER'),
            'user-karo');

        $this->addUser($manager,
            'mesnil.paul@gmail.com',
            'Fabien Mesnilgrente',
            'lv4Uem4OtFmfSYYDGX',
            array('ROLE_USER'),
            'user-fabien');
    }
    
    public function getOrder()
    {
        return 1;
    }
}
