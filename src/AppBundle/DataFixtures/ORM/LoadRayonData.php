<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\Rayon;

class LoadRayonData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $rayons = array(
            'Apéro', 'Boissons',
            'Animaux', 'Salle de bain',
            'Autre', 'Boucherie/Volailles',
            'Charcuterie', 'Conserve', 'Céréales',
            'Crèmerie', 'Condiments',
            'Epices et Aromates', 'Epicerie salée',
            'Légumineuses',
            'Frais', 'Fromages',
            'Fruits', 'Légumes',
            'High-tech', 'Médias', 'Ménagers',
            'Librairie', 'Jardin',
            'Papeterie', 'Patisserie', 
            'Petit déjeuner/Goûter', 'Loisir',
            'Poisson et produits de la mer',
            'Surgelés', 'Viande', 'Yaourts et dessert');

        foreach ($rayons as $rayon) {
            $r = new Rayon();
            $r->setNom($rayon);
            
            $manager->persist($r);
            $manager->flush();
            
            $this->addReference('rayon-'.strtolower($rayon), $r);
        }
    }
    
    public function getOrder()
    {
        return 1;
    }
}
