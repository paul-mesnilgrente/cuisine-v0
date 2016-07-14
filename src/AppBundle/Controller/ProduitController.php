<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Produit;
use AppBundle\Form\ProduitType;
use AppBundle\Form\ProduitSearchType;

/**
 * @Route("/produit")
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

    /**
     * @Route("/formulaire-recherche", name="formulaire_recherche_produit", options = { "expose" = true })
     */
    public function formulaireRechercheAction(Request $request) {
        $form = $this->createForm(new ProduitSearchType());
        return $this->render('produit/form.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/rechercher/{mot}", name="rechercher_produit")
     */
    public function rechercherProduitAction(Request $request, $mot) {
        if ($request->isXmlHttpRequest()) {
            $motcle = '';
            $motcle = $request->request->get('motcle');

            $em = $this->container->getDoctrine()->getManager();

            if ($motcle != '') {
                $produits = $em->getRepository('AppBundle:Produit')->rechercherProduit($mot);
            } else {
                $produits = $em->getRepository('AppBundle:Produit')->findAll();
            }

            return $this->render('admin/produits/liste.html.twig', array(
                'produits' => $produits
                ));
        } else {
            return $this->listerAction();
        }
    }
}
