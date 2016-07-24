<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use AppBundle\Entity\Ingredient;

class LoadIngredientData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function addIngredient(ObjectManager $manager, $rayons, $nomImage, $nom) {
        $ingredient = new Ingredient();
        $ingredient->setNom($nom);
        $ingredient->setImageName($nomImage);

        foreach ($rayons as $rayon) {
            $ingredient->addRayon($this->getReference($rayon));
        }

        $manager->persist($ingredient);
        $manager->flush();

        $this->addReference('ingredient-'.strtolower($nom), $ingredient);
    }

    public function load(ObjectManager $manager)
    {
        $this->addIngredient($manager, array('rayon-apéro'), 'biscuits-apéro.jpg', 'biscuits apéro');
        $this->addIngredient($manager, array('rayon-apéro'), 'cacahuete.jpg', 'cacahuete');
        $this->addIngredient($manager, array('rayon-apéro'), 'chips.jpg', 'chips');
        $this->addIngredient($manager, array('rayon-apéro'), 'fruits-seché.jpg', 'fruit seché');
        $this->addIngredient($manager, array('rayon-apéro'), 'fruits-sec.jpg', 'fruit sec');
        $this->addIngredient($manager, array('rayon-apéro'), 'gressin.jpg', 'gressin');
        $this->addIngredient($manager, array('rayon-apéro'), 'olives.jpg', 'olive');

        $this->addIngredient($manager, array('rayon-boissons'), 'bieres.jpg', 'biere');
        $this->addIngredient($manager, array('rayon-boissons'), 'café.jpg', 'café');
        $this->addIngredient($manager, array('rayon-boissons'), 'eau.jpg', 'eau');
        $this->addIngredient($manager, array('rayon-boissons'), 'eau-pétillante.jpg', 'eau pétillante');
        $this->addIngredient($manager, array('rayon-boissons'), 'jus-de-fruits.jpg', 'jus de fruit');
        $this->addIngredient($manager, array('rayon-boissons'), 'sodas.jpg', 'sodas');
        $this->addIngredient($manager, array('rayon-boissons'), 'the.jpg', 'the');
        $this->addIngredient($manager, array('rayon-boissons'), 'tisanes.jpg', 'tisanes');
        $this->addIngredient($manager, array('rayon-boissons'), 'vin.jpg', 'vin');

        $this->addIngredient($manager, array('rayon-céréales'), 'coquillette.jpg', 'coquillette');
        $this->addIngredient($manager, array('rayon-céréales'), 'farfalle.jpg', 'farfalle');
        $this->addIngredient($manager, array('rayon-céréales'), 'flocon-avoine.jpg', 'flocons d\'avoine');
        $this->addIngredient($manager, array('rayon-céréales'), 'Macaroni.jpg', 'Macaroni');
        $this->addIngredient($manager, array('rayon-céréales'), 'Pâtes.jpg', 'Pâtes');
        $this->addIngredient($manager, array('rayon-céréales'), 'Penne.jpg', 'Penne');
        $this->addIngredient($manager, array('rayon-céréales'), 'polenta.jpg', 'polenta');
        $this->addIngredient($manager, array('rayon-céréales'), 'quinoa.jpg', 'quinoa');
        $this->addIngredient($manager, array('rayon-céréales'), 'riz.jpg', 'riz');
        $this->addIngredient($manager, array('rayon-céréales'), 'riz rond dessert.jpg', 'riz rond dessert');
        $this->addIngredient($manager, array('rayon-céréales'), 'semoule-couscous.jpg', 'semoule/couscous');
        $this->addIngredient($manager, array('rayon-céréales'), 'Spaghetti.jpg', 'Spaghetti');
        $this->addIngredient($manager, array('rayon-céréales'), 'torti.jpg', 'torti');

        $this->addIngredient($manager, array('rayon-condiments'), 'concentre-tomate.jpg', 'concentre de tomate');
        $this->addIngredient($manager, array('rayon-condiments'), 'cornichons.jpg', 'cornichons');
        $this->addIngredient($manager, array('rayon-condiments'), 'huile-de-colza.jpg', 'huile de colza');
        $this->addIngredient($manager, array('rayon-condiments'), 'huile-de-tournesol.jpg', 'huile de tournesol');
        $this->addIngredient($manager, array('rayon-condiments'), 'Huile-d\'olive.jpg', 'Huile d\'olive');
        $this->addIngredient($manager, array('rayon-condiments'), 'ketchup.jpg', 'ketchup');
        $this->addIngredient($manager, array('rayon-condiments'), 'mayonnaise.jpg', 'mayonnaise');
        $this->addIngredient($manager, array('rayon-condiments'), 'moutarde.jpg', 'moutarde');
        $this->addIngredient($manager, array('rayon-condiments'), 'puree-de-tomate.jpg', 'puree de tomate');
        $this->addIngredient($manager, array('rayon-condiments'), 'sauce-soja.jpg', 'sauce soja');
        $this->addIngredient($manager, array('rayon-condiments'), 'tomates-pelees.jpg', 'tomates pelees');
        $this->addIngredient($manager, array('rayon-condiments'), 'vinaigre-blanc.jpg', 'vinaigre blanc');
        $this->addIngredient($manager, array('rayon-condiments'), 'vinaigres.jpg', 'vinaigres');

        $this->addIngredient($manager, array('rayon-crèmerie'), 'beurre.jpg', 'beurre');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'Creme.jpg', 'Creme');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'crème-liquide.jpg', 'crème liquide');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'fromage-blanc.jpg', 'fromage blanc');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'lait.jpg', 'lait');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'margarine.jpg', 'margarine');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'Mozzarella.jpg', 'Mozzarella');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'oeuf.jpg', 'oeuf');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'yaourt.jpg', 'yaourt');

        $this->addIngredient($manager, array('rayon-epices et aromates'), 'aneth.jpg', 'aneth');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'basilic.jpg', 'basilic');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'canelle.jpg', 'canelle');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'cumin.jpg', 'cumin');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'curcuma.jpg', 'curcuma');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'curry.jpg', 'curry');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'gros-sel.jpg', 'gros sel');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'herbe-de-provence.jpg', 'herbe de provence');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'laurier.jpg', 'laurier');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'origan.jpg', 'origan');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'paprika.jpg', 'paprika');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'poivre-noir.jpg', 'poivre noir');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'romarin.jpg', 'romarin');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'sel.jpg', 'sel');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'thym.jpg', 'thym');

        $this->addIngredient($manager, array('rayon-fruits'), 'abricot.jpg', 'abricot');
        $this->addIngredient($manager, array('rayon-fruits'), 'ananas.jpg', 'ananas');
        $this->addIngredient($manager, array('rayon-fruits'), 'banane.jpg', 'banane');
        $this->addIngredient($manager, array('rayon-fruits'), 'cerise.jpg', 'cerise');
        $this->addIngredient($manager, array('rayon-fruits'), 'citron-jaune.jpg', 'citron jaune');
        $this->addIngredient($manager, array('rayon-fruits'), 'citron-vert.jpg', 'citron vert');
        $this->addIngredient($manager, array('rayon-fruits'), 'fraise.jpg', 'fraise');
        $this->addIngredient($manager, array('rayon-fruits'), 'Framboise.jpg', 'Framboise');
        $this->addIngredient($manager, array('rayon-fruits'), 'kiwi.jpg', 'kiwi');
        $this->addIngredient($manager, array('rayon-fruits'), 'mandarine.jpg', 'mandarine');
        $this->addIngredient($manager, array('rayon-fruits'), 'mangue.jpg', 'mangue');
        $this->addIngredient($manager, array('rayon-fruits'), 'melon-espagnol.jpg', 'melon espagnol');
        $this->addIngredient($manager, array('rayon-fruits'), 'melon.jpg', 'melon');
        $this->addIngredient($manager, array('rayon-fruits'), 'nectarines.jpg', 'nectarines');
        $this->addIngredient($manager, array('rayon-fruits'), 'orange.jpg', 'orange');
        $this->addIngredient($manager, array('rayon-fruits'), 'pamplemousse.jpg', 'pamplemousse');
        $this->addIngredient($manager, array('rayon-fruits'), 'pastèque.jpg', 'pastèque');
        $this->addIngredient($manager, array('rayon-fruits'), 'pêche.jpg', 'pêche');
        $this->addIngredient($manager, array('rayon-fruits'), 'poires.jpg', 'poires');
        $this->addIngredient($manager, array('rayon-fruits'), 'pommes.jpg', 'pommes');
        $this->addIngredient($manager, array('rayon-fruits'), 'prunes.jpg', 'prunes');
        $this->addIngredient($manager, array('rayon-fruits'), 'raisin.jpg', 'raisin');

        $this->addIngredient($manager, array('rayon-légumes'), 'Ail.jpg', 'Ail');
        $this->addIngredient($manager, array('rayon-légumes'), 'Asperge-blanche.jpg', 'Asperge blanche');
        $this->addIngredient($manager, array('rayon-légumes'), 'asperges-vertes.jpg', 'asperges vertes');
        $this->addIngredient($manager, array('rayon-légumes'), 'aubergine.jpg', 'aubergine');
        $this->addIngredient($manager, array('rayon-légumes'), 'avocat.jpg', 'avocat');
        $this->addIngredient($manager, array('rayon-légumes'), 'brocolis.jpg', 'brocolis');
        $this->addIngredient($manager, array('rayon-légumes'), 'carottes.jpg', 'carottes');
        $this->addIngredient($manager, array('rayon-légumes'), 'celeri-branche.jpg', 'celeri en branche');
        $this->addIngredient($manager, array('rayon-légumes'), 'celeri-rave.jpg', 'celeri rave');
        $this->addIngredient($manager, array('rayon-légumes'), 'champignon.jpg', 'champignon');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-blanc.jpg', 'chou blanc');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-fleur.jpg', 'chou fleur');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-rouge.jpg', 'chou rouge');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-vert.jpg', 'chou vert');
        $this->addIngredient($manager, array('rayon-légumes'), 'concombre.jpg', 'concombre');
        $this->addIngredient($manager, array('rayon-légumes'), 'courges.jpg', 'courges');
        $this->addIngredient($manager, array('rayon-légumes'), 'courgettes.jpg', 'courgettes');
        $this->addIngredient($manager, array('rayon-légumes'), 'Echalotes.jpg', 'Echalotes');
        $this->addIngredient($manager, array('rayon-légumes'), 'endive.jpg', 'endive');
        $this->addIngredient($manager, array('rayon-légumes'), 'epinards-hacher.jpg', 'epinards hacher');
        $this->addIngredient($manager, array('rayon-légumes'), 'epinards.jpg', 'epinards');
        $this->addIngredient($manager, array('rayon-légumes'), 'haricots_beurre.jpg', 'haricots beurre');
        $this->addIngredient($manager, array('rayon-légumes'), 'haricots-verts.jpg', 'haricots verts');
        $this->addIngredient($manager, array('rayon-légumes'), 'maïs.jpg', 'maïs');
        $this->addIngredient($manager, array('rayon-légumes'), 'navet.jpg', 'navet');
        $this->addIngredient($manager, array('rayon-légumes'), 'oignon-nouveau.jpg', 'oignon nouveau');
        $this->addIngredient($manager, array('rayon-légumes'), 'oignons.jpg', 'oignon');
        $this->addIngredient($manager, array('rayon-légumes'), 'oignons_rouges.jpg', 'oignon rouge');
        $this->addIngredient($manager, array('rayon-légumes'), 'patate-douce.jpg', 'patate douce');
        $this->addIngredient($manager, array('rayon-légumes'), 'petit-pois.jpg', 'petits pois');
        $this->addIngredient($manager, array('rayon-légumes'), 'poireaux.jpg', 'poireau');
        $this->addIngredient($manager, array('rayon-légumes'), 'Poivrons.jpg', 'Poivron');
        $this->addIngredient($manager, array('rayon-légumes'), 'pommes-de-terre.jpg', 'pomme de terre');
        $this->addIngredient($manager, array('rayon-légumes'), 'salade-iceberg.jpg', 'salade iceberg');
        $this->addIngredient($manager, array('rayon-légumes'), 'salade.jpg', 'salade');
        $this->addIngredient($manager, array('rayon-légumes'), 'salade-mache.jpg', 'salade mache');
        $this->addIngredient($manager, array('rayon-légumes'), 'tomate-coeur-boeuf.jpg', 'tomate coeur de boeuf');
        $this->addIngredient($manager, array('rayon-légumes'), 'tomates-cerises.jpg', 'tomate cerises');
        $this->addIngredient($manager, array('rayon-légumes'), 'tomates.jpg', 'tomate');

        $this->addIngredient($manager, array('rayon-légumineuses'), 'fève.jpg', 'fève');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'flageolet.jpg', 'flageolet');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'haricot-rouge.jpg', 'haricots rouges');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'haricots-blancs.jpg', 'haricots blancs');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'lentilles.jpg', 'lentilles');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'corail.jpg', 'lentilles corails');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'pois cassés.jpg', 'pois cassés');

        $this->addIngredient($manager, array('rayon-patisserie'), 'farine.jpg', 'farine');
        $this->addIngredient($manager, array('rayon-patisserie'), 'fecule-de-mais.jpg', 'fecule de mais');
        $this->addIngredient($manager, array('rayon-patisserie'), 'levure.jpg', 'levure');
        $this->addIngredient($manager, array('rayon-patisserie'), 'pate-d-amandes.jpg', 'pate d\'amandes');
        $this->addIngredient($manager, array('rayon-patisserie'), 'poudre-amande.jpg', 'poudre d\'amande');
        $this->addIngredient($manager, array('rayon-patisserie'), 'sucre-en-poudre.jpg', 'sucre en poudre');
        $this->addIngredient($manager, array('rayon-patisserie'), 'sucres-en-morceaux.jpg', 'sucres en morceaux');
        $this->addIngredient($manager, array('rayon-patisserie'), 'sucre-vanille.jpg', 'sucre vanille');

        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'biscottes.jpg', 'biscottes');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'céréales.jpg', 'céréales');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'chocolat-en-poudre.jpg', 'chocolat en poudre');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'compote.jpg', 'compote');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'confitures.jpg', 'confitures');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'Galette-de-riz.jpg', 'Galette de riz');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'goûter.jpg', 'goûter');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'krisprolls.jpg', 'krisprolls');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'miel.jpg', 'miel');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'Muesli.jpg', 'Muesli');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain-de-mie.jpg', 'pain de mie');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain-hamburgers.jpg', 'pain hamburgers');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain.jpg', 'pain');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain-précuit.jpg', 'pain précuit');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pate à tartiner.jpg', 'pate à tartiner');

        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'cabillaud.jpg', 'cabillaud');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'carpe.jpg', 'carpe');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'crevettes.jpg', 'crevettes');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'merlan.jpg', 'merlan');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'moules.jpg', 'moules');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'rouget.jpg', 'rouget');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'sardine.jpg', 'sardine');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'saumon-fume.jpg', 'saumon fume');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'saumon.jpg', 'saumon');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'thon.jpg', 'thon');

        $this->addIngredient($manager, array('rayon-viande'), 'chipolata.jpg', 'chipolata');
        $this->addIngredient($manager, array('rayon-viande'), 'escalope-dinde.jpg', 'escalope dinde');
        $this->addIngredient($manager, array('rayon-viande'), 'filet-dinde.jpg', 'filet dinde');
        $this->addIngredient($manager, array('rayon-viande'), 'jambon-blanc.jpg', 'jambon blanc');
        $this->addIngredient($manager, array('rayon-viande'), 'jambon-cru.jpg', 'jambon cru');
        $this->addIngredient($manager, array('rayon-viande'), 'lardons.jpg', 'lardons');
        $this->addIngredient($manager, array('rayon-viande'), 'merguez.jpg', 'merguez');
        $this->addIngredient($manager, array('rayon-viande'), 'poulet.jpg', 'poulet');
        $this->addIngredient($manager, array('rayon-viande'), 'roti-de-boeuf.jpg', 'roti de boeuf');
        $this->addIngredient($manager, array('rayon-viande'), 'saucisses-strasbourg.jpg', 'saucisses strasbourg');
        $this->addIngredient($manager, array('rayon-viande'), 'saucisses-toulouse.jpg', 'saucisse de toulouse');
        $this->addIngredient($manager, array('rayon-viande'), 'steak-hache.jpg', 'steak hache');
        $this->addIngredient($manager, array('rayon-viande'), 'viande-haché.jpg', 'viande haché');
    }
    
    public function getOrder()
    {
        return 2;
    }
}
