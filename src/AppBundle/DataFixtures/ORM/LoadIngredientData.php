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

    private function addIngredient(ObjectManager $manager, $rayons, $nomImage, $nom, $pluriel) {
        $ingredient = new Ingredient();
        $ingredient->setNom($nom);
        $ingredient->setPluriel($pluriel);
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
        $this->addIngredient($manager, array('rayon-apéro'), 'biscuits-apéro.jpg', 'biscuits apéro', 'biscuits apéros');
        $this->addIngredient($manager, array('rayon-apéro'), 'cacahuete.jpg', 'cacahuete', 'cacahuetes');
        $this->addIngredient($manager, array('rayon-apéro'), 'chips.jpg', 'chips', 'chips');
        $this->addIngredient($manager, array('rayon-apéro'), 'fruits-seché.jpg', 'fruit seché', 'fruits sechés');
        $this->addIngredient($manager, array('rayon-apéro'), 'fruits-sec.jpg', 'fruit sec', 'fruits secs');
        $this->addIngredient($manager, array('rayon-apéro'), 'gressin.jpg', 'gressin', 'gressins');
        $this->addIngredient($manager, array('rayon-apéro'), 'olives.jpg', 'olive', 'olives');

        $this->addIngredient($manager, array('rayon-boissons'), 'bieres.jpg', 'biere', 'bieres');
        $this->addIngredient($manager, array('rayon-boissons'), 'café.jpg', 'café', 'cafés');
        $this->addIngredient($manager, array('rayon-boissons'), 'eau.jpg', 'eau', 'eaux');
        $this->addIngredient($manager, array('rayon-boissons'), 'eau-pétillante.jpg', 'eau pétillante', 'eau pétillantes');
        $this->addIngredient($manager, array('rayon-boissons'), 'jus-de-fruits.jpg', 'jus de fruit', 'jus de fruits');
        $this->addIngredient($manager, array('rayon-boissons'), 'sodas.jpg', 'sodas', 'sodas');
        $this->addIngredient($manager, array('rayon-boissons'), 'the.jpg', 'the', 'thes');
        $this->addIngredient($manager, array('rayon-boissons'), 'tisanes.jpg', 'tisanes', 'tisanes');
        $this->addIngredient($manager, array('rayon-boissons'), 'vin.jpg', 'vin', 'vins');

        $this->addIngredient($manager, array('rayon-céréales'), 'coquillette.jpg', 'coquillette', 'coquillettes');
        $this->addIngredient($manager, array('rayon-céréales'), 'farfalle.jpg', 'farfalle', 'farfalles');
        $this->addIngredient($manager, array('rayon-céréales'), 'flocon-avoine.jpg', 'flocons d\'avoine', 'flocon d\'avoines');
        $this->addIngredient($manager, array('rayon-céréales'), 'Macaroni.jpg', 'Macaroni', 'Macaronis');
        $this->addIngredient($manager, array('rayon-céréales'), 'Pâtes.jpg', 'Pâtes', 'Pâtes');
        $this->addIngredient($manager, array('rayon-céréales'), 'Penne.jpg', 'Penne', 'Pennes');
        $this->addIngredient($manager, array('rayon-céréales'), 'polenta.jpg', 'polenta', 'polentas');
        $this->addIngredient($manager, array('rayon-céréales'), 'quinoa.jpg', 'quinoa', 'quinoas');
        $this->addIngredient($manager, array('rayon-céréales'), 'riz.jpg', 'riz', 'rizs');
        $this->addIngredient($manager, array('rayon-céréales'), 'riz rond dessert.jpg', 'riz rond dessert', 'riz rond desserts');
        $this->addIngredient($manager, array('rayon-céréales'), 'semoule-couscous.jpg', 'semoule/couscous', 'semoule/couscous');
        $this->addIngredient($manager, array('rayon-céréales'), 'Spaghetti.jpg', 'Spaghetti', 'Spaghettis');
        $this->addIngredient($manager, array('rayon-céréales'), 'torti.jpg', 'torti', 'tortis');

        $this->addIngredient($manager, array('rayon-condiments'), 'concentre-tomate.jpg', 'concentre de tomate', 'concentre de tomates');
        $this->addIngredient($manager, array('rayon-condiments'), 'cornichons.jpg', 'cornichons', 'cornichons');
        $this->addIngredient($manager, array('rayon-condiments'), 'huile-de-colza.jpg', 'huile de colza', 'huile de colzas');
        $this->addIngredient($manager, array('rayon-condiments'), 'huile-de-tournesol.jpg', 'huile de tournesol', 'huile de tournesols');
        $this->addIngredient($manager, array('rayon-condiments'), 'Huile-d\'olive.jpg', 'Huile d\'olive', 'Huile d\'olives');
        $this->addIngredient($manager, array('rayon-condiments'), 'ketchup.jpg', 'ketchup', 'ketchups');
        $this->addIngredient($manager, array('rayon-condiments'), 'mayonnaise.jpg', 'mayonnaise', 'mayonnaises');
        $this->addIngredient($manager, array('rayon-condiments'), 'moutarde.jpg', 'moutarde', 'moutardes');
        $this->addIngredient($manager, array('rayon-condiments'), 'puree-de-tomate.jpg', 'puree de tomate', 'puree de tomates');
        $this->addIngredient($manager, array('rayon-condiments'), 'sauce-soja.jpg', 'sauce soja', 'sauce sojas');
        $this->addIngredient($manager, array('rayon-condiments'), 'tomates-pelees.jpg', 'tomates pelees', 'tomates pelees');
        $this->addIngredient($manager, array('rayon-condiments'), 'vinaigre-blanc.jpg', 'vinaigre blanc', 'vinaigre blancs');
        $this->addIngredient($manager, array('rayon-condiments'), 'vinaigres.jpg', 'vinaigres', 'vinaigres');

        $this->addIngredient($manager, array('rayon-crèmerie'), 'beurre.jpg', 'beurre', 'beurres');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'Creme.jpg', 'Creme', 'Cremes');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'crème-liquide.jpg', 'crème liquide', 'crème liquides');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'fromage-blanc.jpg', 'fromage blanc', 'fromage blancs');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'lait.jpg', 'lait', 'laits');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'margarine.jpg', 'margarine', 'margarines');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'Mozzarella.jpg', 'Mozzarella', 'Mozzarellas');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'oeuf.jpg', 'oeuf', 'oeufs');
        $this->addIngredient($manager, array('rayon-crèmerie'), 'yaourt.jpg', 'yaourt', 'yaourts');

        $this->addIngredient($manager, array('rayon-epices et aromates'), 'aneth.jpg', 'aneth', 'aneths');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'basilic.jpg', 'basilic', 'basilics');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'canelle.jpg', 'canelle', 'canelles');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'cumin.jpg', 'cumin', 'cumins');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'curcuma.jpg', 'curcuma', 'curcumas');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'curry.jpg', 'curry', 'currys');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'gros-sel.jpg', 'gros sel', 'gros sels');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'herbe-de-provence.jpg', 'herbe de provence', 'herbe de provences');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'laurier.jpg', 'laurier', 'lauriers');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'origan.jpg', 'origan', 'origans');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'paprika.jpg', 'paprika', 'paprikas');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'poivre-noir.jpg', 'poivre noir', 'poivre noirs');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'romarin.jpg', 'romarin', 'romarins');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'sel.jpg', 'sel', 'sels');
        $this->addIngredient($manager, array('rayon-epices et aromates'), 'thym.jpg', 'thym', 'thyms');

        $this->addIngredient($manager, array('rayon-fruits'), 'abricot.jpg', 'abricot', 'abricots');
        $this->addIngredient($manager, array('rayon-fruits'), 'ananas.jpg', 'ananas', 'ananas');
        $this->addIngredient($manager, array('rayon-fruits'), 'banane.jpg', 'banane', 'bananes');
        $this->addIngredient($manager, array('rayon-fruits'), 'cerise.jpg', 'cerise', 'cerises');
        $this->addIngredient($manager, array('rayon-fruits'), 'citron-jaune.jpg', 'citron jaune', 'citron jaunes');
        $this->addIngredient($manager, array('rayon-fruits'), 'citron-vert.jpg', 'citron vert', 'citron verts');
        $this->addIngredient($manager, array('rayon-fruits'), 'fraise.jpg', 'fraise', 'fraises');
        $this->addIngredient($manager, array('rayon-fruits'), 'Framboise.jpg', 'Framboise', 'Framboises');
        $this->addIngredient($manager, array('rayon-fruits'), 'kiwi.jpg', 'kiwi', 'kiwis');
        $this->addIngredient($manager, array('rayon-fruits'), 'mandarine.jpg', 'mandarine', 'mandarines');
        $this->addIngredient($manager, array('rayon-fruits'), 'mangue.jpg', 'mangue', 'mangues');
        $this->addIngredient($manager, array('rayon-fruits'), 'melon-espagnol.jpg', 'melon espagnol', 'melon espagnols');
        $this->addIngredient($manager, array('rayon-fruits'), 'melon.jpg', 'melon', 'melons');
        $this->addIngredient($manager, array('rayon-fruits'), 'nectarines.jpg', 'nectarines', 'nectarines');
        $this->addIngredient($manager, array('rayon-fruits'), 'orange.jpg', 'orange', 'oranges');
        $this->addIngredient($manager, array('rayon-fruits'), 'pamplemousse.jpg', 'pamplemousse', 'pamplemousses');
        $this->addIngredient($manager, array('rayon-fruits'), 'pastèque.jpg', 'pastèque', 'pastèques');
        $this->addIngredient($manager, array('rayon-fruits'), 'pêche.jpg', 'pêche', 'pêches');
        $this->addIngredient($manager, array('rayon-fruits'), 'poires.jpg', 'poires', 'poires');
        $this->addIngredient($manager, array('rayon-fruits'), 'pommes.jpg', 'pommes', 'pommes');
        $this->addIngredient($manager, array('rayon-fruits'), 'prunes.jpg', 'prunes', 'prunes');
        $this->addIngredient($manager, array('rayon-fruits'), 'raisin.jpg', 'raisin', 'raisins');

        $this->addIngredient($manager, array('rayon-légumes'), 'Ail.jpg', 'Ail', 'Ails');
        $this->addIngredient($manager, array('rayon-légumes'), 'Asperge-blanche.jpg', 'Asperge blanche', 'Asperge blanches');
        $this->addIngredient($manager, array('rayon-légumes'), 'asperges-vertes.jpg', 'asperges vertes', 'asperges vertes');
        $this->addIngredient($manager, array('rayon-légumes'), 'aubergine.jpg', 'aubergine', 'aubergines');
        $this->addIngredient($manager, array('rayon-légumes'), 'avocat.jpg', 'avocat', 'avocats');
        $this->addIngredient($manager, array('rayon-légumes'), 'brocolis.jpg', 'brocolis', 'brocolis');
        $this->addIngredient($manager, array('rayon-légumes'), 'carottes.jpg', 'carottes', 'carottes');
        $this->addIngredient($manager, array('rayon-légumes'), 'celeri-branche.jpg', 'celeri en branche', 'celeri en branches');
        $this->addIngredient($manager, array('rayon-légumes'), 'celeri-rave.jpg', 'celeri rave', 'celeri raves');
        $this->addIngredient($manager, array('rayon-légumes'), 'champignon.jpg', 'champignon', 'champignons');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-blanc.jpg', 'chou blanc', 'chou blancs');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-fleur.jpg', 'chou fleur', 'chou fleurs');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-rouge.jpg', 'chou rouge', 'chou rouges');
        $this->addIngredient($manager, array('rayon-légumes'), 'chou-vert.jpg', 'chou vert', 'chou verts');
        $this->addIngredient($manager, array('rayon-légumes'), 'concombre.jpg', 'concombre', 'concombres');
        $this->addIngredient($manager, array('rayon-légumes'), 'courges.jpg', 'courges', 'courges');
        $this->addIngredient($manager, array('rayon-légumes'), 'courgettes.jpg', 'courgettes', 'courgettes');
        $this->addIngredient($manager, array('rayon-légumes'), 'Echalotes.jpg', 'Echalotes', 'Echalotes');
        $this->addIngredient($manager, array('rayon-légumes'), 'endive.jpg', 'endive', 'endives');
        $this->addIngredient($manager, array('rayon-légumes'), 'epinards-hacher.jpg', 'epinards hacher', 'epinards hachers');
        $this->addIngredient($manager, array('rayon-légumes'), 'epinards.jpg', 'epinards', 'epinards');
        $this->addIngredient($manager, array('rayon-légumes'), 'haricots_beurre.jpg', 'haricots beurre', 'haricots beurres');
        $this->addIngredient($manager, array('rayon-légumes'), 'haricots-verts.jpg', 'haricots verts', 'haricots verts');
        $this->addIngredient($manager, array('rayon-légumes'), 'maïs.jpg', 'maïs', 'maïs');
        $this->addIngredient($manager, array('rayon-légumes'), 'navet.jpg', 'navet', 'navets');
        $this->addIngredient($manager, array('rayon-légumes'), 'oignon-nouveau.jpg', 'oignon nouveau', 'oignons nouveaux');
        $this->addIngredient($manager, array('rayon-légumes'), 'oignons.jpg', 'oignon', 'oignons');
        $this->addIngredient($manager, array('rayon-légumes'), 'oignons_rouges.jpg', 'oignon rouge', 'oignons rouges');
        $this->addIngredient($manager, array('rayon-légumes'), 'patate-douce.jpg', 'patate douce', 'patate douces');
        $this->addIngredient($manager, array('rayon-légumes'), 'petit-pois.jpg', 'petits pois', 'petits pois');
        $this->addIngredient($manager, array('rayon-légumes'), 'poireaux.jpg', 'poireau', 'poireaux');
        $this->addIngredient($manager, array('rayon-légumes'), 'Poivrons.jpg', 'Poivron', 'Poivrons');
        $this->addIngredient($manager, array('rayon-légumes'), 'pommes-de-terre.jpg', 'pomme de terre', 'pommes de terres');
        $this->addIngredient($manager, array('rayon-légumes'), 'salade-iceberg.jpg', 'salade iceberg', 'salades icebergs');
        $this->addIngredient($manager, array('rayon-légumes'), 'salade.jpg', 'salade', 'salades');
        $this->addIngredient($manager, array('rayon-légumes'), 'salade-mache.jpg', 'salade mache', 'salades maches');
        $this->addIngredient($manager, array('rayon-légumes'), 'tomate-coeur-boeuf.jpg', 'tomate coeur de boeuf', 'tomates coeurs de boeufs');
        $this->addIngredient($manager, array('rayon-légumes'), 'tomates-cerises.jpg', 'tomate cerises', 'tomates cerises');
        $this->addIngredient($manager, array('rayon-légumes'), 'tomates.jpg', 'tomate', 'tomates');

        $this->addIngredient($manager, array('rayon-légumineuses'), 'fève.jpg', 'fève', 'fèves');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'flageolet.jpg', 'flageolet', 'flageolets');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'haricot-rouge.jpg', 'haricots rouges', 'haricots rouges');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'haricots-blancs.jpg', 'haricots blancs', 'haricot blancs');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'lentilles.jpg', 'lentilles', 'lentilles');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'corail.jpg', 'lentilles corails', 'lentilles corails');
        $this->addIngredient($manager, array('rayon-légumineuses'), 'pois cassés.jpg', 'pois cassés', 'pois cassés');

        $this->addIngredient($manager, array('rayon-patisserie'), 'farine.jpg', 'farine', 'farines');
        $this->addIngredient($manager, array('rayon-patisserie'), 'fecule-de-mais.jpg', 'fecule de mais', 'fecule de mais');
        $this->addIngredient($manager, array('rayon-patisserie'), 'levure.jpg', 'levure', 'levures');
        $this->addIngredient($manager, array('rayon-patisserie'), 'pate-d-amandes.jpg', 'pate d\'amandes', 'pates d\'amandes');
        $this->addIngredient($manager, array('rayon-patisserie'), 'poudre-amande.jpg', 'poudre d\'amande', 'poudre d\'amandes');
        $this->addIngredient($manager, array('rayon-patisserie'), 'sucre-en-poudre.jpg', 'sucre en poudre', 'sucre en poudres');
        $this->addIngredient($manager, array('rayon-patisserie'), 'sucres-en-morceaux.jpg', 'sucres en morceaux', 'sucres en morceauxs');
        $this->addIngredient($manager, array('rayon-patisserie'), 'sucre-vanille.jpg', 'sucre vanille', 'sucre vanilles');

        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'biscottes.jpg', 'biscottes', 'biscottes');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'céréales.jpg', 'céréales', 'céréales');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'chocolat-en-poudre.jpg', 'chocolat en poudre', 'chocolat en poudres');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'compote.jpg', 'compote', 'compotes');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'confitures.jpg', 'confitures', 'confitures');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'Galette-de-riz.jpg', 'Galette de riz', 'Galette de rizs');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'goûter.jpg', 'goûter', 'goûters');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'krisprolls.jpg', 'krisprolls', 'krisprolls');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'miel.jpg', 'miel', 'miels');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'Muesli.jpg', 'Muesli', 'Mueslis');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain-de-mie.jpg', 'pain de mie', 'pain de mies');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain-hamburgers.jpg', 'pain hamburgers', 'pain hamburgers');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain.jpg', 'pain', 'pains');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pain-précuit.jpg', 'pain précuit', 'pain précuits');
        $this->addIngredient($manager, array('rayon-petit déjeuner/goûter'), 'pate à tartiner.jpg', 'pate à tartiner', 'pate à tartiners');

        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'cabillaud.jpg', 'cabillaud', 'cabillauds');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'carpe.jpg', 'carpe', 'carpes');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'crevettes.jpg', 'crevettes', 'crevettes');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'merlan.jpg', 'merlan', 'merlans');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'moules.jpg', 'moules', 'moules');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'rouget.jpg', 'rouget', 'rougets');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'sardine.jpg', 'sardine', 'sardines');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'saumon-fume.jpg', 'saumon fume', 'saumon fumes');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'saumon.jpg', 'saumon', 'saumons');
        $this->addIngredient($manager, array('rayon-poisson et produits de la mer'), 'thon.jpg', 'thon', 'thons');

        $this->addIngredient($manager, array('rayon-viande'), 'chipolata.jpg', 'chipolata', 'chipolatas');
        $this->addIngredient($manager, array('rayon-viande'), 'escalope-dinde.jpg', 'escalope dinde', 'escalope dindes');
        $this->addIngredient($manager, array('rayon-viande'), 'filet-dinde.jpg', 'filet dinde', 'filet dindes');
        $this->addIngredient($manager, array('rayon-viande'), 'jambon-blanc.jpg', 'jambon blanc', 'jambons blancs');
        $this->addIngredient($manager, array('rayon-viande'), 'jambon-cru.jpg', 'jambon cru', 'jambon crus');
        $this->addIngredient($manager, array('rayon-viande'), 'lardons.jpg', 'lardons', 'lardons');
        $this->addIngredient($manager, array('rayon-viande'), 'merguez.jpg', 'merguez', 'merguezs');
        $this->addIngredient($manager, array('rayon-viande'), 'poulet.jpg', 'poulet', 'poulets');
        $this->addIngredient($manager, array('rayon-viande'), 'roti-de-boeuf.jpg', 'roti de boeuf', 'rotis de boeufs');
        $this->addIngredient($manager, array('rayon-viande'), 'saucisses-strasbourg.jpg', 'saucisses strasbourg', 'saucisses de strasbourgs');
        $this->addIngredient($manager, array('rayon-viande'), 'saucisses-toulouse.jpg', 'saucisse de toulouse', 'saucisses de toulouses');
        $this->addIngredient($manager, array('rayon-viande'), 'steak-hache.jpg', 'steak hache', 'steak haches');
        $this->addIngredient($manager, array('rayon-viande'), 'viande-haché.jpg', 'viande haché', 'viandes hachés');
    }
    
    public function getOrder()
    {
        return 2;
    }
}
