<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

use AppBundle\Entity\ListeDeCourse;
use AppBundle\Form\ListeDeCourseType;
use AppBundle\Entity\Periode;

use AppBundle\Entity\EntreeListe;
use AppBundle\Entity\User;

use AppBundle\Form\EntreeListeType;

/**
 * @Route("/liste-de-course")
 * @Security("has_role('ROLE_USER')")
 */
class ListeDeCourseController extends Controller
{
    private function formulaireListeDeCourseAction(Request $request, ListeDeCourse $liste, $formDate, $action)
    {
        $formListeDeCourse = $this->createForm(new ListeDeCourseType(), $liste);
        $formListeDeCourse->handleRequest($request);

        if ($formListeDeCourse->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($liste);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("La catégorie de recette a bien été soumise à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/liste-de-course/form.html.twig', array(
            'formListeDeCourse' => $formListeDeCourse->createView(),
            'formDate' => $formDate->createView(),
            'action' => $action));
    }

    private function creerFormulaire(Periode $periode)
    {
        $formBuilder = $this->get('form.factory')->createBuilder('form', $periode);
        $formBuilder->add('dateDebut', 'date')->add('dateFin', 'date');
        return $formBuilder->getForm();
    }

    /**
     * @Route("/ajouter", name="ajouter_liste_de_course")
     */
    public function ajouterListeDeCourseAction(Request $request)
    {
        $user = $this->getUser();
        $periode = new Periode();
        $formDate = $this->creerFormulaire($periode);
        $formDate->handleRequest($request);
        if ($formDate->isSubmitted()) {
            if ((!$formDate->isValid()) || $periode->getDateDebut() > $periode->getDateFin()) {
                $flash = $this->get('braincrafted_bootstrap.flash');
                $flash->info("Les informations sur les dates ne sont pas valides.");
                $periode = new Periode();
                $formDate = $this->creerFormulaire($periode);
            }
        }
        
        $liste = new ListeDeCourse($user);
        $em = $this->getDoctrine()->getManager();

        $entrees = $em->getRepository('AppBundle:EntreePlanning')->getByDate(
            $periode->getDateDebut(), $periode->getDateFin());
        foreach ($entrees as $entree)
        {
            foreach ($entree->getRecettes() as $recette)
            {
                foreach($recette->getIngredients() as $ingredient)
                {
                    $ing = new QuantiteIngredientListeDeCourse();
                    $ing->setQuantite($ingredient->getQuantite());
                    $ing->setListeDeCourse($liste);
                    $ing->setUnite($ingredient->getUnite());
                    $ing->setIngredient($ingredient->getIngredient());
                    $liste->addIngredient($ing);
                }
            }
        }

        return $this->formulaireListeDeCourseAction($request, $liste, $formDate, "Ajouter");
    }

    /**
     * @Route("/modifier/{id}", name="modifier_liste_de_course")
     */
    public function modifierListeDeCourseAction(Request $request, ListeDeCourse $liste)
    {
        return $this->formulaireListeDeCourseAction($request, $liste, "Modifier");
    }

    private function creerListeUser() {
        $liste = new ListeDeCourse($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($liste);
        $em->flush();

        return $liste;
    }

    public function listeAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AppBundle:ListeDeCourse')->findOneByUser($user);
        if ($liste === null) {
            $liste = $this->creerListeUser();
        }
        $rayons = $em->getRepository('AppBundle:Rayon')->findAll();
        return $this->render('liste-de-course/liste.html.twig', array(
            'rayons' => $rayons,
            'liste' => $liste));
    }

    /**
     * @Route("/faire-mes-courses", name="faire_mes_courses")
     */
    public function faireMesCoursesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rayons = $em->getRepository('AppBundle:Rayon')->findAll();
        return $this->render('liste-de-course/faire-mes-courses.html.twig', array(
            'rayons' => $rayons));
    }

    /**
     * @Route("/formulaire-recherche", options={"expose"=true}, name="formulaire_recherche_produit")
     */
    public function formulaireRechercheAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AppBundle:ListeDeCourse')->findOneByUser(
            array('user' => $user));

        $entree = new EntreeListe($liste);
        $form = $this->createForm(EntreeListeType::class, $entree);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $rayon = $em->getRepository('AppBundle:Rayon')
                ->findOneByNom(explode(' : ', $entree->getRayonProduit())[0]);
            $produit = $em->getRepository('AppBundle:Produit')
                ->findOneByNom(explode(' : ', $entree->getRayonProduit())[1]);

            if ($rayon === null) {
                 $form->get('rayonProduit')->addError(new FormError('
                    Le rayon indiqué n\'existe pas.'));
            }
            if ($produit === null) {
                 $form->get('rayonProduit')->addError(new FormError('
                    Le produit indiqué n\'existe pas.'));
            }

            if ($form->isValid()) {
                $entree->setRayon($rayon);
                $entree->setProduit($produit);

                $em->persist($entree);
                $em->flush();
                $flash = $this->get('braincrafted_bootstrap.flash');
                $flash->info("Bien ajouté.");
                return $this->redirectToRoute('user_tableau_de_bord');
            } else {
                $flash = $this->get('braincrafted_bootstrap.flash');
                $err = '<ul>';
                foreach ($form->getErrors() as $error) {
                    $err = $err.'<li>'.$error->getMessage().'</li>';
                }
                $err = $err.'</ul>';
                $flash->error($err);
                return $this->redirectToRoute('user_tableau_de_bord');
            }
        }

        return $this->render('liste-de-course/form-recherche.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/rechercher/{caracteres}", options={"expose"=true}, name="rechercher_entree_liste")
     */
    public function rechercherProduitAction(Request $request, $caracteres) {
        $em = $this->getDoctrine()->getManager();

        if ($caracteres != '') {
            $rayons = $em->getRepository('AppBundle:Rayon')->rechercherProduits($caracteres);
        } else {
            $rayons = $em->getRepository('AppBundle:Rayon')->findAll();
        }

        return $this->render('liste-de-course/resultat-recherche.json.twig', array(
            'rayons' => $rayons));
    }
}
