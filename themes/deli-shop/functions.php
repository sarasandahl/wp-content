<?php 

//uppsättning av menyer
function mytheme_menus(){
    $locations = array(
        'primary' => "Header Primary Menu",
        'blogg' => "Blogg Menu Sidebar",
        'page' => "Page Menu Sidebar"
    );

    register_nav_menus($locations);
}

add_action('init','mytheme_menus');

/* Woocommerce */
function customtheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'customtheme_add_woocommerce_support' );