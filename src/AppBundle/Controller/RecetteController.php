<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\QuantiteIngredientRecette;
use AppBundle\Entity\Recette;
use AppBundle\Form\RecetteType;

/**
 * @Route("admin/recette")
 */
class RecetteController extends Controller
{

    private function formulaireRecetteAction(Request $request, Recette $recette, $action)
    {
        $form = $this->createForm(new RecetteType(), $recette);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("La recette a bien été soumise à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/recette/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }

    /**
     * @Route("/ajouter", name="ajouter_recette")
     */
    public function ajouterRecetteAction(Request $request)
    {
        $recette = new Recette();
        $recette->addIngredient(new QuantiteIngredientRecette());
        $recette->setEtapes(array(""));
        
        return $this->formulaireRecetteAction($request, $recette, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_recette")
     */
    public function modifierRecetteAction(Request $request, Recette $recette)
    {
        return $this->formulaireRecetteAction($request, $recette, "Modifier");
    }
}
