<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\CategorieRecette;
use AppBundle\Form\CategorieRecetteType;

/**
 * @Route("admin/categorie-recette")
 */
class CategorieRecetteController extends Controller
{

    private function formulaireCategorieRecetteAction(Request $request, CategorieRecette $categorieRecette, $action)
    {
        $form = $this->createForm(new CategorieRecetteType(), $categorieRecette);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieRecette);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("La catégorie de recette a bien été soumise à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/categorie-recette/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }

    /**
     * @Route("/ajouter", name="ajouter_categorie_recette")
     */
    public function ajouterCategorieRecetteAction(Request $request)
    {
        $categorieRecette = new CategorieRecette();
        
        return $this->formulaireCategorieRecetteAction($request, $categorieRecette, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_categorie_recette")
     */
    public function modifierCategorieRecetteAction(Request $request, CategorieRecette $categorieRecette)
    {
        return $this->formulaireCategorieRecetteAction($request, $categorieRecette, "Modifier");
    }
}
