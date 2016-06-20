<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\EntreePlanning;
use AppBundle\Form\EntreePlanningType;

/**
 * @Route("admin/planning")
 */
class PlanningController extends Controller
{

    private function formulaireEntreePlanningAction(Request $request, EntreePlanning $entreePlanning, $action)
    {
        $form = $this->createForm(new EntreePlanningType(), $entreePlanning);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entreePlanning);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("L'entrée du planning a bien été soumise.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/planning/form.html.twig', array(
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
        $entreePlanning = new EntreePlanning();
        $entreePlanning->setDate($date);
        $m = $repas == "midi" ? true : false;
        $entreePlanning->setMidi($m);
        
        return $this->formulaireEntreePlanningAction($request, $entreePlanning, "Ajouter");
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_entree_planning")
     */
    public function modifierEntreePlanningAction(Request $request, EntreePlanning $entreePlanning)
    {
        return $this->formulaireEntreePlanningAction($request, $entreePlanning, "Modifier");
    }
}
