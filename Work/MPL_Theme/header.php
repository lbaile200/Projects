<!DOCTYPE html>
<html>
    <head>

        <?php wp_head();?>

    </head>
<body <?php body_class();?>>

<header class="sticky-top">
<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
  <div class="container">
    <div style="float: left;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="#"><?php the_custom_logo();?></a>
    </div>

        <div>
        <?php 
        /*wp_nav_menu (
          array(
             'theme_location' => 'top-menu',
              'menu_class' => 'navigation',
          )
            */
          wp_nav_menu( array(
            'theme_location'  => 'top-menu',
            'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'bs-example-navbar-collapse-1',
            'menu_class'      => 'navbar-nav mr-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
        </div>
    </div>
</nav>



</header>

