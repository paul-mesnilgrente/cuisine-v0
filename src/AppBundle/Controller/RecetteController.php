<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\QuantiteIngredientRecette;
use AppBundle\Entity\Recette;
use AppBundle\Entity\User;
use AppBundle\Form\RecetteType;

/**
 * @Route("{slugUser}/recette")
 */
class RecetteController extends Controller
{

    /**
     * @Route("/liste", name="liste_recette")
     */
    public function listeRecetteAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $recettes = $em->getRepository('AppBundle:Recette')->findAll(
            array('user' => $user),
            array('date' => 'desc'));
        return $this->render('recette/liste.html.twig', array(
            'recettes' => $recettes));
    }

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
    public function ajouterRecetteAction(Request $request, User $user)
    {
        $recette = new Recette($user);
        $recette->addIngredient(new QuantiteIngredientRecette());
        $recette->setEtapes(array(""));
        
        return $this->formulaireRecetteAction($request, $recette, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_recette")
     */
    public function modifierRecetteAction(Request $request, User $user, Recette $recette)
    {
        return $this->formulaireRecetteAction($request, $recette, "Modifier");
    }

    /**
     * @Route("/{slug}", name="voir_recette")
     */
    public function voirRecetteAction(Request $request, User $user, Recette $recette)
    {
        return $this->render('recette/voir.html.twig', array(
            'recette' => $recette));
    }

    /**
     * @Route("/execution/{slug}/etape-{etape}",
     *         name="executer_recette",
     *         defaults={"etape": "0"},
     *         requirements={"etape": "\d+"}
     *       )
     */
    public function executerRecetteAction(Request $request, User $user, Recette $recette, $etape)
    {
        return $this->render('recette/executer.html.twig', array(
            'recette' => $recette,
            'etape' => $etape));
    }
}
