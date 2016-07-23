<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function leftMenu(FactoryInterface $factory, array $options)
    {
        $security = $this->container->get('security.token_storage');
        $user = $security->getToken()->getUser();
        $auth = $this->container->get('security.authorization_checker');

        $menu = $factory->createItem('root');
        $menu->addChild("Accueil", array('route' => 'homepage'));
        if ($auth->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addChild("Consulter recettes", array('route' => 'liste_recette', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
        }
        return $menu;
    }

    public function rightMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $security = $this->container->get('security.token_storage');
        $user = $security->getToken()->getUser();
        $translator = $this->container->get('translator');
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $menu->addChild($user->getUsername(), array('route' => 'user_ma_page', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu->addChild("Tableau de bord", array('route' => 'user_tableau_de_bord', 'routeParameters' => array('slugUser' => $user->getSlugUser())));

            $menu->addChild("Mes actions")->setAttribute('dropdown', true);
            $menu['Mes actions']->addChild("Ajouter une recette", array('route' => 'ajouter_recette', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu['Mes actions']->addChild("Ajouter produit ménager", array('route' => 'ajouter_produit', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu['Mes actions']->addChild("Ajouter un ingrédient", array('route' => 'ajouter_ingredient', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu['Mes actions']->addChild("Liste des ingrédients", array('route' => 'liste_ingredient'));
            $menu['Mes actions']->addChild("Liste des produits", array('route' => 'liste_produit'));

            $menu['Mes actions']->addChild("#")->setAttribute('divider', true);
            $menu['Mes actions']->addChild('Paramètre', array('route' => 'fos_user_profile_show'));
            $menu['Mes actions']->addChild($translator->trans('layout.logout', array('%username%' => $user), 'FOSUserBundle'), array('route' => 'fos_user_security_logout'));
        } else {
            $menu->addChild($translator->trans('layout.login', array(), 'FOSUserBundle'), array('route' => 'fos_user_security_login'));
            $menu->addChild($translator->trans('layout.register', array(), 'FOSUserBundle'), array('route' => 'fos_user_registration_register'));
        }
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Admin')
                ->setAttribute('dropdown', true);
            $menu['Admin']->addChild('Ajouter une catégorie de recette', array('route' => 'ajouter_categorie_recette'));
            $menu['Admin']->addChild('Ajouter une unité', array('route' => 'ajouter_unite'));
            $menu['Admin']->addChild('Ajouter une catégorie ingrédient', array('route' => 'ajouter_categorie_ingredient'));
            $menu['Admin']->addChild('Ajouter un tag de recette', array('route' => 'ajouter_tag_recette'));
        }
        return $menu;
    }
}
