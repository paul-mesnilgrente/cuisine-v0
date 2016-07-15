<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\EntreePlanning;
use AppBundle\Entity\User;
use AppBundle\Form\EntreePlanningType;

/**
 * @Route("{slugUser}/planning")
 */
class PlanningController extends Controller
{
    private function formulaireEntreePlanningAction(Request $request, EntreePlanning $entreePlanning, User $user, $action)
    {
        $form = $this->createForm(new EntreePlanningType(), $entreePlanning);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entreePlanning);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("L'entrée du planning a bien été soumise.");

            return $this->redirectToRoute('consulter_planning', array(
                'date' => $entreePlanning->getDate()->format('d-m-Y'),
                'slugUser' => $user->getSlugUser()));
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
    public function ajouterEntreePlanningAction(Request $request, User $user, \Datetime $date, $repas)
    {
        $entreePlanning = new EntreePlanning($user);
        $entreePlanning->setDate($date);
        $m = $repas == "midi" ? true : false;
        $entreePlanning->setMidi($m);
        
        return $this->formulaireEntreePlanningAction($request, $entreePlanning, $user, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_entree_planning")
     */
    public function modifierEntreePlanningAction(Request $request, User $user, EntreePlanning $entreePlanning)
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

    public function recupererPlanning(User $user, \Datetime $dateDebut) {
        $dateFin = clone $dateDebut;
        $dateFin->modify('Sunday');

        $em = $this->getDoctrine()->getManager();
        $planning = $em->getRepository("AppBundle:EntreePlanning")
            ->getEntre2Dates($user, $dateDebut, $dateFin);

        return $planning;
    }

    /**
     * @Route("/planning/consulter/{date}", name="consulter_planning")
     */
    public function consulterPlanningAction(Request $request, User $user, \Datetime $date)
    {
        $dateDebut = $this->getDebutSemaine($date);
        $planning = $this->recupererPlanning($user, $dateDebut);
        return $this->render('planning/consulter.html.twig', array(
            'planning' => $planning,
            'dateDebut' => $dateDebut));
    }

    public function tableauAction(User $user) {
        $dateDebut = $this->getDebutSemaine(new \Datetime());
        $planning = $this->recupererPlanning($user, $dateDebut);
        return $this->render('planning/tableau.html.twig', array(
            'planning' => $planning,
            'dateDebut' => $dateDebut));
    }
}
