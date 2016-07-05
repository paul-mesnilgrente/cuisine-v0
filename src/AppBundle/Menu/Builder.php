<?php
namespace AppBundle\Menu;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Builder extends ContainerAware
{
    private $factory;
    protected $container;
    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->container = $container;
    }

    public function leftMenu(RequestStack $requestStack)
    {
        $security = $this->container->get('security.context');
        $user = $security->getToken()->getUser();

        $menu = $this->factory->createItem('root');
        $menu->addChild("Accueil", array('route' => 'homepage'));
        if ($security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addChild("Consulter recettes", array('route' => 'liste_recette', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
        }
        return $menu;
    }

    public function rightMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $security = $this->container->get('security.context');
        $user = $security->getToken()->getUser();
        $translator = $this->container->get('translator');
        if ($security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addChild("Tableau de bord", array('route' => 'user_tableau_de_bord', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu->addChild($translator->trans('layout.logout', array('%username%' => $user), 'FOSUserBundle'), array('route' => 'fos_user_security_logout'));
            $menu->addChild('Profil', array('route' => 'fos_user_profile_show'));
        } else {
            $menu->addChild($translator->trans('layout.login', array(), 'FOSUserBundle'), array('route' => 'fos_user_security_login'));
            $menu->addChild($translator->trans('layout.register', array(), 'FOSUserBundle'), array('route' => 'fos_user_registration_register'));
        }
        return $menu;
    }

    public function footer(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $security = $this->container->get('security.context');
        $user = $security->getToken()->getUser();
        $translator = $this->container->get('translator');
        if ($security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addChild('Ajouter une recette', array('route' => 'ajouter_recette', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu->addChild('Créer une liste de course', array('route' => 'ajouter_liste_de_course', 'routeParameters' => array('slugUser' => $user->getSlugUser())));
            $menu->addChild('Ajouter un ingrédient', array('route' => 'ajouter_ingredient'));
            
            $menu->addChild('Autre')->setAttribute('dropdown', true);
            $menu['Autre']->addChild('Ajouter une catégorie de recette', array('route' => 'ajouter_categorie_recette'));
            $menu['Autre']->addChild('Ajouter une unité', array('route' => 'ajouter_unite'));
            $menu['Autre']->addChild('Ajouter une catégorie ingrédient', array('route' => 'ajouter_categorie_ingredient'));
            $menu['Autre']->addChild('Ajouter un tag de recette', array('route' => 'ajouter_tag_recette'));
            $menu['Autre']->addChild('Ajouter un produit ménager', array('route' => 'ajouter_produit'));
        }
        return $menu;
    }
}
