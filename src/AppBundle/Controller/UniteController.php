<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Unite;
use AppBundle\Form\UniteType;

/**
 * @Route("admin/unite")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UniteController extends Controller
{

    private function formulaireUniteAction(Request $request, Unite $unite, $action)
    {
        $form = $this->createForm(new UniteType(), $unite);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unite);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("L'unité a bien été soumis à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/unite/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }

    /**
     * @Route("/ajouter", name="ajouter_unite")
     */
    public function ajouterUniteAction(Request $request)
    {
        $unite = new Unite();
        
        return $this->formulaireUniteAction($request, $unite, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_unite")
     */
    public function modifierUniteAction(Request $request, Unite $unite)
    {
        return $this->formulaireUniteAction($request, $unite, "Modifier");
    }
}
