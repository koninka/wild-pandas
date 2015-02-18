<?php

namespace SlashStudio\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('navigation.team');
        $menu['navigation.team']->addChild('navigation.players', ['route' => 'slash_app_team_players']);
        $menu['navigation.team']->addChild('navigation.training', ['route' => 'slash_app_team_info', 'routeParameters' => ['action' => 'training']]);
        $menu['navigation.team']->addChild('navigation.history', ['route' => 'slash_app_team_info', 'routeParameters' => ['action' => 'history']]);
        $menu['navigation.team']->addChild('navigation.baby_team', ['route' => 'slash_app_team_info', 'routeParameters' => ['action' => 'baby_team']]);

        $menu->addChild('navigation.media');
        $menu['navigation.media']->addChild('navigation.photo', ['route' => 'slash_app_media_photo']);
        $menu['navigation.media']->addChild('navigation.video', ['route' => 'slash_app_media_video']);
        $menu['navigation.media']->addChild('navigation.media_about', ['route' => 'slash_app_media_about']);

        $menu->addChild('navigation.cheerleader', ['route' => 'slash_app_chearleaders']);
        $menu->addChild('navigation.products', ['route' => 'slash_app_products_list']);
        $menu->addChild('navigation.partnership', ['route' => 'slash_app_partnership']);
        $menu->addChild('navigation.blog', ['route' => 'slash_app_blog_list']);

        return $menu;
    }
}
