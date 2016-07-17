<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\CategorieRecette;

class LoadCategorieRecetteData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $categories = array(
            'Apéro', 'Salade', 
            'Entrée', 'Plat',
            'Fromage', 'Dessert');

        foreach ($categories as $categorie) {
            $r = new CategorieRecette();
            $r->setNom($categorie);
            $manager->persist($r);
            $manager->flush();
            
            $this->addReference('cat-recette-'.strtolower($categorie), $r);
        }
    }
    
    public function getOrder()
    {
        return 1;
    }
}
