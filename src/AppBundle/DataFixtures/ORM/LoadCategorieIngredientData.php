<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\CategorieIngredient;

class LoadCategorieIngredientData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $categories = array('Assaisonnement', 'Féculent', 'Fruit', 'Graîne', 'Herbe', 'Légume', 'Légumineuse', 'Poisson', 'Viande');

        foreach ($categories as $categorie) {
            $c = new CategorieIngredient();
            $c->setNom($categorie);
            $manager->persist($c);
            $manager->flush();
            
            $this->addReference('cat-int-'.strtolower($categorie), $c);
        }
    }
    
    public function getOrder()
    {
        return 1;
    }
}
