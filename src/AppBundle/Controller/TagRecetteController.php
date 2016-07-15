<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\TagRecette;
use AppBundle\Form\TagRecetteType;

/**
 * @Route("admin/tag-recette")
 * @Security("has_role('ROLE_USER')")
 */
class TagRecetteController extends Controller
{

    private function formulaireTagRecetteAction(Request $request, TagRecette $tagRecette, $action)
    {
        $form = $this->createForm(new TagRecetteType(), $tagRecette);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tagRecette);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("La catégorie de recette a bien été soumise à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/tag-recette/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }

    /**
     * @Route("/ajouter", name="ajouter_tag_recette")
     */
    public function ajouterTagRecetteAction(Request $request)
    {
        $tagRecette = new TagRecette();
        
        return $this->formulaireTagRecetteAction($request, $tagRecette, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_tag_recette")
     */
    public function modifierTagRecetteAction(Request $request, TagRecette $tagRecette)
    {
        return $this->formulaireTagRecetteAction($request, $tagRecette, "Modifier");
    }
}
