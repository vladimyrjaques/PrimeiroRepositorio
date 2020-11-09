<?php


class RegisterMenu
{

    public function registerMenu ()
    {
        add_theme_support('menus');
        register_nav_menus(
            array(
                'main_menu' => __('Main Menu', 'ypyfranquia'),
            ));
        add_action('init', 'registerMenu');
    }

    public function registerMenuFooter ()
    {
        add_theme_support('menus');
        register_nav_menus(
            array(
                'menu_footer' => __('Menu Footer', 'ypyfranquia'),
            ));
        add_action('init', 'registerMenuFooter');
    }

    
}

