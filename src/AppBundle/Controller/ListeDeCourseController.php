<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\ListeDeCourse;
use AppBundle\Form\ListeDeCourseType;
use AppBundle\Entity\Periode;

use AppBundle\Entity\QuantiteIngredientListeDeCourse;

/**
 * @Route("admin/liste-de-course")
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
        
        $liste = new ListeDeCourse();
        $em = $this->getDoctrine()->getManager();

        $entrees = $em->getRepository('AppBundle:EntreePlanning')->getEntreesEntre2Dates(
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
}
