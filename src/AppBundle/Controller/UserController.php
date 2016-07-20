<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Entity\QuantiteProduit;

use AppBundle\Form\ProduitSearchType;

/**
 * @Route("/{slugUser}")
 * @Security("has_role('ROLE_USER')")
 */
class UserController extends Controller
{
    /**
     * @Route("/tableau-de-bord", name="user_tableau_de_bord")
     */
    public function tableauDeBordAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('AppBundle:ListeDeCourse')->findOneByUser($user);

        $qp = new QuantiteProduit($liste);
        $form = $this->createForm(ProduitSearchType::class, $qp);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($qp);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("Bien ajouté.");
            $this->redirectToRoute('user_tableau_de_bord', array(
                'slugUser' => $user->getSlugUser()));
        }

        return $this->render('user/tableau_de_bord.html.twig');
    }

    /**
     * @Route("/", name="user_ma_page")
     */
    public function maPageAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $recettes = $em->getRepository('AppBundle:Recette')->getPubliques($user);
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
