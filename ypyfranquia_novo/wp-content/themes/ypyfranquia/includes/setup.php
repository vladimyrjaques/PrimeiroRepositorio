<?php

require_once ('RegisterMenu.php');
require_once ('Archive.php');
require_once ('register_posts.php');

$registerMenu = new RegisterMenu();
$registerMenu->registerMenu();
//$registerMenu->registerMenuFooter();

$archives = new Archive();
$archives->callArchives();


// HOOKS

add_action('init', 'register_post_depoimentos');
add_action('init', 'register_post_blog');
add_action('init', 'register_post_solucoes');


add_theme_support('post-thumbnails');
