<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\QuantiteIngredientRecette;
use AppBundle\Entity\Recette;
use AppBundle\Entity\User;
use AppBundle\Form\RecetteType;

/**
 * @Route("/recette")
 * @Security("has_role('ROLE_USER')")
 */
class RecetteController extends Controller
{
    private function formulaireRecetteAction(Request $request, Recette $recette, $action)
    {
        $form = $this->createForm(RecetteType::class, $recette);
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
        $recette = new Recette($this->getUser());
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
        return $this->render('recette/consulter.html.twig', array(
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

    /**
     * @Route("/ingredients/{caracteres}", options={"expose"=true}, name="autocomplete_ingredient_recette")
     */
    public function autocompleteIngredient(Request $request, $caracteres) {
        $em = $this->getDoctrine()->getManager();
        $ingredients = $em->getRepository('AppBundle:Ingredient')->rechercherIngredient($caracteres);

        return $this->render('recette/autocomplete_ingredient.json.twig', array(
            'ingredients' => $ingredients));
    }

    /**
     * @Route("/chercher/{caracteres}", options={"expose"=true}, name="chercher_recette")
     */
    public function chercherRecetteAction($caracteres)
    {
        $em = $this->getDoctrine()->getManager();
        $recettes = $em->getRepository('AppBundle:Recette')->search($caracteres);

        return $this->render('recette/reponse_ajax.html.twig', array(
            'recettes' => $recettes));
    }
}
