<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\Unite;

class LoadUniteData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function addUnite(ObjectManager $manager, $singulier, $pluriel, $abrege) {
        $unite = new Unite();
        $unite->setNom($singulier);
        $unite->setPluriel($pluriel);
        $unite->setAbrege($abrege);
        
        $manager->persist($unite);
        $manager->flush();
        
        $this->addReference('unite-'.strtolower($singulier), $unite);
    }
    
    public function load(ObjectManager $manager)
    {
        $this->addUnite($manager, 'milligramme', 'milligrammes', 'mg');
        $this->addUnite($manager, 'gramme', 'grammes', 'g');
        $this->addUnite($manager, 'kilogramme', 'kilogrammes', 'kg');
        $this->addUnite($manager, 'pincée', 'pincées', 'pincée');
        $this->addUnite($manager, 'cube', 'cubes', 'cube');
        $this->addUnite($manager, 'poignée', 'poignées', 'poignée');
        $this->addUnite($manager, 'cuillère à soupe', 'cuillères à soupe', 'c.a.s.');
        $this->addUnite($manager, 'cuillère à café', 'cuillères à café', 'c.a.c.');
        $this->addUnite($manager, 'litre', 'litres', 'L');
        $this->addUnite($manager, 'centilitre', 'centilitres', 'cl');
        $this->addUnite($manager, 'millilitre', 'millilitres', 'ml');
        $this->addUnite($manager, 'verre', 'verres', 'verre');
    }
    
    public function getOrder()
    {
        return 1;
    }
}
