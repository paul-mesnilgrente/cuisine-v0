<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\TagRecette;

class LoadTagRecetteData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $tags = array(
            'végétarien', 'végétalien', 
            'fruitalien', 'omnivore',
            'simple', 'occasion', 'long', 'facile',
            'rapide');

        foreach ($tags as $tag) {
            $r = new TagRecette();
            $r->setNom($tag);
            $manager->persist($r);
            $manager->flush();
            
            $this->addReference('tag-recette-'.strtolower($tag), $r);
        }
    }
    
    public function getOrder()
    {
        return 1;
    }
}
