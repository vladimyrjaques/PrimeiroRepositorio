<!doctype html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>YPY Franquia</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" m/>
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Crete+Round:ital@0;1&family=Jost:wght@100&family=Montserrat:wght@100&family=Open+Sans&family=Roboto:wght@900&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
  <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" data-auto-replace-svg="nest"></script>

  <!--  SLICK -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!--Style CSS -->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel = "stylesheet">

</head>

<body>

<?php DEFINE('URL', get_template_directory_uri());?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav-container">
    <div class="container">
      <a class="navbar-brand" href="/"> <img class="img-fluid logo-site" src="<?= URL?>/assets/img/logo.png" alt=""> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

        <?php
        if (has_nav_menu('main_menu')) {
//            wp_nav_menu(array(
//                'menu' => 'main_menu',
//                'container' => 'div',
//                'container_class' => 'ml-auto',
//                'container_id' => 'menu_top',
//                'menu_class' => 'navbar-nav p-2',
//                'depth' => 2,
//                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
//                'walker' => new WP_Bootstrap_Navwalker()
//            ));
            wp_nav_menu(array(
                'menu' => 'Main Menu',
                'container' => 'nav',
                'container_id' => 'container',
            ));
        }
        ?>

    </div>
  </nav>

<style>
    /* CSS Document */

    @import url(https://fonts.googleapis.com/css?family=Open+Sans);
    @import url(https://fonts.googleapis.com/css?family=Bree+Serif);

    nav {
        margin: 50px 0;
        background-color: #e9e7e7;
        margin:0;
    }

    nav ul {
        padding: 0;
        margin: 0;
        list-style: none;
        position: relative;
        display: flex;
        justify-content: flex-end;
    }
    nav#container > ul {
        margin-left: 20rem;
    }

    nav ul li {
        display:inline-block;
    }

    nav a {
        display:block;
        padding:0 10px;
        color:rgba(0, 0, 0, 0.5);
        font-size:15px;
        line-height: 60px;
        text-decoration:none;
        text-transform: uppercase;
    }

    nav a:hover {
        color:rgb(163 60 60);
        text-decoration: none;
    }


    /* Hide Dropdowns by Default */
    nav ul ul {
        display: none;
        position: absolute;
        background: #e9e7e7;
    }

    /* Display Dropdowns on Hover */
    nav ul li:hover > ul {
        display:inherit;
    }

    /* Fisrt Tier Dropdown */
    nav ul ul li {
        width:170px;
        float:none;
        display:list-item;
        position: relative;
        background: #e9e7e7;
        margin: 0px 1px;
    }

    /* Second, Third and more Tiers	*/
    nav ul ul ul li {
        position: relative;
        top:-60px;
        right:170px;
    }
    nav ul ul ul li a {
        font-size: 10pt;
    }

    div#select {
        width: 100%;
        margin-left: 50%;
        transform: translateX(-50%);
    }

    @media (max-width: 992px) {
        nav#container > ul {
            display: flex;
            margin: 0;
            flex-direction: column;
        }
        nav ul ul li {
            display: none;
        }
    }

    @media (min-width: 992px) and (max-width: 1192px) {
        nav#container > ul {
            margin-left: 0px;
        }
    }
</style>