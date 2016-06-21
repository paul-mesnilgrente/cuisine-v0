<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Recette;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/recette/liste", name="liste_recette")
     */
    public function listeRecetteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recettes = $em->getRepository('AppBundle:Recette')->findAll(
            array(),
            array('date' => 'desc'));
        return $this->render('default/recette/liste.html.twig', array(
            'recettes' => $recettes));
    }
    
    /**
     * @Route("/recette/{slug}", name="voir_recette")
     */
    public function voirRecetteAction(Request $request, Recette $recette)
    {
        return $this->render('default/recette/voir.html.twig', array(
            'recette' => $recette));
    }

    /**
     * @Route("/recette/execution/{slug}/etape-{etape}",
     *         name="executer_recette",
     *         defaults={"etape": "0"},
     *         requirements={"etape": "\d+"}
     *       )
     */
    public function executerRecetteAction(Request $request, Recette $recette, $etape)
    {
        return $this->render('default/recette/executer.html.twig', array(
            'recette' => $recette,
            'etape' => $etape));
    }

    /**
     * @Route("/planning/consulter/{date}", name="consulter_planning")
     */
    public function consulterPlanningAction(Request $request, \Datetime $date)
    {
        $dateDebut = clone $date;
        if ($date->format('l') != 'Monday') {
            $dateDebut->modify("last Monday");
        }
        $dateFin = clone $dateDebut;
        $dateFin->modify('Sunday');
        $em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository("AppBundle:EntreePlanning")
            ->getEntreesEntre2Dates($dateDebut, $dateFin);
        return $this->render('default/planning/consulter.html.twig', array(
            'planning' => $planning,
            'dateDebut' => $dateDebut));
    }

    /**
     * @Route("/liste-de-course/sauvegardes", name="consulter_listes_de_course")
     */
    public function consulterListesDeCourseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $liste = $em->getRepository('AppBundle:ListeDeCourse')->findAll();

        return $this->render('default/liste-de-course/sauvegarde.html.twig', array(
            'liste' => $liste));
    }

    /**
     * @Route("/liste-de-course/{id}", name="consulter_liste_de_course")
     */
    public function consulterListeDeCourseAction(Request $request, ListeDeCourse $liste)
    {
        return $this->render('default/liste-de-course/consulter.html.twig', array(
            'liste' => $liste));
    }
}
