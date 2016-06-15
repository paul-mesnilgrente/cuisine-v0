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
}
