<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\ListeDeCourse;
use AppBundle\Form\ListeDeCourseType;
use AppBundle\Entity\Periode;

use AppBundle\Entity\QuantiteIngredientListeDeCourse;
use AppBundle\Entity\QuantiteProduit;
use AppBundle\Entity\User;

use AppBundle\Form\ProduitSearchType;

/**
 * @Route("{slugUser}/liste-de-course")
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
    public function ajouterListeDeCourseAction(Request $request, User $user)
    {
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
    public function modifierListeDeCourseAction(Request $request, User $user, ListeDeCourse $liste)
    {
        return $this->formulaireListeDeCourseAction($request, $liste, "Modifier");
    }

    private function creerListeUser(User $user) {
        $liste = new ListeDeCourse($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($liste);
        $em->flush();

        return $liste;
    }

    public function listeAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AppBundle:ListeDeCourse')->findOneByUser($user);
        if ($liste === null) {
            $liste = $this->creerListeUser($user);
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
    public function formulaireRechercheAction(Request $request, User $user) {
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AppBundle:ListeDeCourse')->findAll(
            array('user' => $user));
        $qp = new QuantiteProduit($liste);
        $form = $this->createForm(ProduitSearchType::class, $qp);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($liste);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("Bien ajouté.");
            $this->redirectToRoute('user_tableau_de_bord', array(
                'slugUser' => $user->getSlugUser()));
        }
        return $this->render('liste-de-course/form-recherche.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/rechercher/{caracteres}", options={"expose"=true}, name="rechercher_produit")
     */
    public function rechercherProduitAction(Request $request, $caracteres) {
        $em = $this->getDoctrine()->getManager();

        if ($caracteres != '') {
            $produits = $em->getRepository('AppBundle:Produit')->rechercherProduit($caracteres);
        } else {
            $produits = $em->getRepository('AppBundle:Produit')->findAll();
        }

        return $this->render('liste-de-course/resultat-recherche.html.twig', array(
            'produits' => $produits));
    }
}
