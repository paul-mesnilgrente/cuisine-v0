<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\Produit;

class LoadProduitData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function addProduits(ObjectManager $manager, $noms, $rayons) {
        foreach ($noms as $nom) {

            $produit = new Produit();
            $produit->setNom($nom);

            foreach ($rayons as $rayon) {
                $produit->addRayon($rayon);
            }

            $manager->persist($produit);
            $manager->flush();

            $this->addReference('produit-'.strtolower($nom), $produit);
        }
    }

    public function load(ObjectManager $manager)
    {
        $produits = array(
            'adoussissant',
            'aluminium',
            'dépoussierant',
            'éponge',
            'lessive',
            'liquide vaisselle',
            'nettoyant salle de bain',
            'nettoyant sol',
            'nettoyant vitre',
            'nettoyant WC',
            'papier cuisson',
            'papier étirable',
            'sac poubelle',
            'sac de congélation',
            'sopalin');
        $rayons = array($this->getReference('rayon-ménagers'));
        $this->addProduits($manager, $produits, $rayons);

        $produits = array(
            'coton',
            'démaquillant',
            'dentifrice',
            'brosse à dent',
            'bain de bouche',
            'shampooing',
            'après-shampooing',
            'soin capillaire',
            'coiffants',
            'gel fixateur',
            'coloration',
            'gel douche',
            'déodorant',
            'crème hydratante',
            'savon',
            'serviette hygiénique',
            'tampon',
            'mousse à raser',
            'lame de rasoir',
            'rasoir',
            'rasoir jetable',
            'parfum',
            'mouchoirs',
            'collants',
            'bas',
            'mis-bas',
            'papier toilettes',
            'protège slip');

        $rayons = array($this->getReference('rayon-salle de bain'));
        $this->addProduits($manager, $produits, $rayons);
    }
    
    public function getOrder()
    {
        return 2;
    }
}
