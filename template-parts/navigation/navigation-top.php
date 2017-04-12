<nav id="site-navigation" class="main-navigation" role="navigation">
    <button aria-controls="menu-main-menu"
            aria-expanded="false"
            id="menu-toggle"
            class="navbar-toggle menu-toggle">

        <span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation','alps' ); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

    </button>

    <?php

    wp_nav_menu(
        array(
            'theme_location'    => 'primary',
            'menu_id'           => 'primary-menu small-text'
        )
    );
    ?>
</nav>
