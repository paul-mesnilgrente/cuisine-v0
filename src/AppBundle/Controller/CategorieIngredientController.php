<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\CategorieIngredient;
use AppBundle\Form\CategorieIngredientType;

/**
 * @Route("admin/categorie-ingredient")
 * @Security("has_role('ROLE_ADMIN')")
 */
class CategorieIngredientController extends Controller
{
    /**
     * @Route("/ajouter", name="ajouter_categorie_ingredient")
     */
    public function ajouterCategorieIngredientAction(Request $request)
    {
        $catIngredient = new CategorieIngredient();
        $form = $this->createForm(new CategorieIngredientType(), $catIngredient);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($catIngredient);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("La catégorie d'ingrédient a bien été ajouté à la base.");
        }
        
        return $this->render('admin/categorie-ingredient/form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Ajouter"));
    }
}
