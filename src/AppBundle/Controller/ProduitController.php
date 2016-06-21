<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Produit;
use AppBundle\Form\ProduitType;

/**
 * @Route("admin/produit")
 */
class ProduitController extends Controller
{

    private function formulaireProduitAction(Request $request, Produit $produit, $action)
    {
        $form = $this->createForm(new ProduitType(), $produit);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("Le produit ménager a bien été soumis.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/produit/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }

    /**
     * @Route("/ajouter", name="ajouter_produit")
     */
    public function ajouterProduitAction(Request $request)
    {
        $produit = new Produit();
        
        return $this->formulaireProduitAction($request, $produit, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_produit")
     */
    public function modifierProduitAction(Request $request, Produit $produit)
    {
        return $this->formulaireTagRecetteAction($request, $produit, "Modifier");
    }
}