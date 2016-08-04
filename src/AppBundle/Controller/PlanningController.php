<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\EntreePlanning;
use AppBundle\Entity\User;
use AppBundle\Form\EntreePlanningType;

/**
 * @Route("/planning")
 * @Security("has_role('ROLE_USER')")
 */
class PlanningController extends Controller
{
    private function formulaireEntreePlanningAction(Request $request, EntreePlanning $entreePlanning, $action)
    {
        $user = $this->getUser();
        $form = $this->createForm(new EntreePlanningType(), $entreePlanning);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entreePlanning);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("L'entrée du planning a bien été soumise.");

            return $this->redirectToRoute('user_tableau_de_bord');
        }
        // replace this example code with whatever you need
        return $this->render('planning/form.html.twig', array(
            'form' => $form->createView(),
            'entreePlanning' => $entreePlanning,
            'action' => $action));
    }

    /**
     * @Route("/ajouter/{date}/{repas}",
     *  name="ajouter_entree_planning",
     *  requirements={"repas": "midi|soir"})
     */
    public function ajouterEntreePlanningAction(Request $request, \Datetime $date, $repas)
    {
        $entreePlanning = new EntreePlanning($this->getUser());
        $entreePlanning->setDate($date);
        $m = $repas == "midi" ? true : false;
        $entreePlanning->setMidi($m);
        
        return $this->formulaireEntreePlanningAction($request, $entreePlanning, $user, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_entree_planning")
     */
    public function modifierEntreePlanningAction(Request $request, EntreePlanning $entreePlanning)
    {
        return $this->formulaireEntreePlanningAction($request, $entreePlanning, "Modifier");
    }

    private function getDebutSemaine(\Datetime $date) {
        $dateDebut = clone $date;
        if ($date->format('l') != 'Monday') {
            $dateDebut->modify("last Monday");
        }
        return $dateDebut;
    }

    public function recupererPlanning(\Datetime $dateDebut) {
        $dateFin = clone $dateDebut;
        $dateFin->modify('Sunday');

        $em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository("AppBundle:EntreePlanning")
            ->getEntre2Dates($this->getUser(), $dateDebut, $dateFin);

        return $planning;
    }

    /**
     * @Route("/tableau/{date}", name="tableau_planning")
     */
    public function tableauAction(\Datetime $date) {
        $dateDebut = $this->getDebutSemaine($date);
        $planning = $this->recupererPlanning($dateDebut);
        return $this->render('planning/tableau.html.twig', array(
            'planning' => $planning,
            'dateDebut' => $dateDebut));
    }

    /**
     * @Route("/tableau-body/{date}", options={"expose" = true}, name="tableau_body_planning")
     */
    public function tableauBodyAction(\Datetime $date) {
        $dateDebut = $this->getDebutSemaine($date);
        $planning = $this->recupererPlanning($dateDebut);
        return $this->render('planning/tableau_body.html.twig', array(
            'planning' => $planning,
            'dateDebut' => $dateDebut));
    }
}
