<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Ingredient;
use AppBundle\Form\IngredientType;

/**
 * @Security("has_role('ROLE_USER')")
 */
class IngredientController extends Controller
{

    private function formulaireIngredientAction(Request $request, Ingredient $ingredient, $action)
    {
        $form = $this->createForm(new IngredientType(), $ingredient);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();
            
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("L'ingrédient a bien été soumis à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/ingredient/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }

    /**
     * @Route("/ingredient/ajouter", name="ajouter_ingredient")
     */
    public function ajouterIngredientAction(Request $request)
    {
        $ingredient = new Ingredient();
        
        return $this->formulaireIngredientAction($request, $ingredient, "Ajouter");
    }

    /**
     * @Route("/ingredient/modifier/{slug}", name="modifier_ingredient")
     */
    public function modifierIngredientAction(Request $request, Ingredient $ingredient)
    {
        return $this->formulaireIngredientAction($request, $ingredient, "Modifier");
    }

    /**
     * @Route("/mes-ingredients", name="liste_ingredient")
     */
    public function listerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ingredients = $em->getRepository('AppBundle:Rayon')->getIngredients();
        return $this->render('admin/ingredient/liste.html.twig', array(
            'rayons' => $ingredients));
    }
}
