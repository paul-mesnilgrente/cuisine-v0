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
        $menu = $this->factory->createItem('root');
        $menu->addChild("Accueil", array('route' => 'homepage'));
        $menu->addChild("Consulter planning", array('route' => 'consulter_planning', 'routeParameters' => array('date' => date('d-m-Y', strtotime("now")))));
        $menu->addChild("Consulter recettes", array('route' => 'liste_recette'));
        return $menu;
    }

    public function rightMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $security = $this->container->get('security.context');
        $username = $security->getToken()->getUser();
        $translator = $this->container->get('translator');
        if ($security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addChild($translator->trans('layout.logout', array('%username%' => $username), 'FOSUserBundle'), array('route' => 'fos_user_security_logout'));
            $menu->addChild('Profil', array('route' => 'fos_user_profile_show'));
        } else {
            $menu->addChild($translator->trans('layout.login', array(), 'FOSUserBundle'), array('route' => 'fos_user_security_login'));
            $menu->addChild($translator->trans('layout.register', array(), 'FOSUserBundle'), array('route' => 'fos_user_registration_register'));
        }
        return $menu;
    }
}
