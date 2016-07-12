<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Recette;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            
            return $this->redirectToRoute('user_tableau_de_bord', array(
                'slugUser' => $user->getSlugUser()));
        }

        return $this->render('default/index.html.twig');
    }
}
