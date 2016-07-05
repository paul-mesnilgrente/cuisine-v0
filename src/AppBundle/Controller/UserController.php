<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/{slugUser}/tableau-de-bord", name="user_tableau_de_bord")
     */
    public function tableauDeBordAction(Request $request, User $user)
    {
        return $this->render('user/tableau_de_bord.html.twig');
    }
}
