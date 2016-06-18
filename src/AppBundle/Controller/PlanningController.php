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
            $flash->info("La catégorie de recette a bien été soumise à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/planning/form.html.twig', array(
            'form' => $form->createView(),
            'action' => $action));
    }
    /**
     * @Route("/ajouter/{jour}/{mois}/{annee}/{midi}",
     *  name="ajouter_planning_prerempli",
     *  requirements={
     *      "annee": "\d+",
     *      "mois": "\d+",
     *      "jour": "\d+",
     *      "midi": "midi|soir"})
     */
    public function planningPreRempliAction(Request $request, $jour, $mois, $annee, $midi)
    {
        $entreePlanning = new EntreePlanning();
        $date = date_create_from_format('d m Y', $jour.' '.$mois.' '.$annee);
        $entreePlanning->setDate($date);
        $entreePlanning->setMidi($midi == "midi" ? true: false);

        $form = $this->createForm(new EntreePlanningType(), $entreePlanning);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entreePlanning);
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            $flash->info("La catégorie de recette a bien été soumise à la base.");
        }
        // replace this example code with whatever you need
        return $this->render('admin/planning/form.html.twig', array(
            'form' => $form->createView(),
            'date' => $date,
            'action' => "Ajouter"));
        
        return $this->formulaireEntreePlanningAction($request, $entreePlanning, "Ajouter");
    }

    /**
     * @Route("/ajouter", name="ajouter_entree_planning")
     */
    public function ajouterEntreePlanningAction(Request $request)
    {
        $entreePlanning = new EntreePlanning();
        
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
