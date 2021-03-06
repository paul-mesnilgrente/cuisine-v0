<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

use AppBundle\Entity\User;
use AppBundle\Entity\EntreeListe;

use AppBundle\Form\EntreeListeType;

/**
 * @Route("/")
 * @Security("has_role('ROLE_USER')")
 */
class UserController extends Controller
{
    /**
     * @Route("/mon-tableau-de-bord", name="user_tableau_de_bord")
     */
    public function tableauDeBordAction(Request $request)
    {
        return $this->render('user/tableau_de_bord.html.twig');
    }

    /**
     * @Route("/{slugUser}", name="user_ma_page")
     */
    public function maPageAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        // $recettes = $em->getRepository('AppBundle:Recette')->getPubliques($user);
        $recettes = $em->getRepository('AppBundle:Recette')->findBy(array(), array('nom' => 'asc'));

        return $this->render('user/ma_page.html.twig', array(
            'recettes' => $recettes));
    }

    /**
     * @Route("/cuisiner", name="user_cuisiner")
     */
    public function cuisinerAction(Request $request, User $user)
    {
        $date = new \Datetime();
        $em = $this->getDoctrine()->getManager();
        $recettes = $em->getRepository('AppBundle:EntreePlanning')->getByDate($user, $date, $date);

        if (count($recettes) == 0) {
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("Il n'y a rien de prévu.");
            return $this->redirectToRoute('user_tableau_de_bord', array(
            'slugUser' => $user->getSlugUser()));
        }

        return $this->redirectToRoute('executer_recette', array(
            'slugUser' => $user->getSlugUser(),
            'slug' => $recette->getSlug()));
    }
}
