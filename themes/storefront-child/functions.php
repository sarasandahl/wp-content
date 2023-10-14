<?php 

//Menyer
function mytheme_menus(){
    $locations = array(
        'footer' => "Footer Menu"
    );

    register_nav_menus($locations);
}

add_action('init','mytheme_menus');

//Custom Post Type-lösning för fysiska butiker
function create_posttype() {
    register_post_type( 'butiker',
    // CPT-val
        array(
            'labels' => array(
                'name' => __( 'Butiker', 'plural' ), // Namnger i singular
                'singular_name' => __( 'Butik', 'singular' ) // Namnger i plural
            ),
                'public' => true, // Alla ska få göra ändringar i admin-panelen
                'query_var' => true, // Skapa en query-variabel för post-typen
                'has_archive' => false, // Om posten har arkiv eller inte
                'rewrite' => array('slug' => 'butiker'), // Skriver om vad sluggen blir
                'hierarchical' => false, // Ska de behandlas som sidor (true) eller inlägg (false)?
                'menu_icon'   => 'dashicons-products',
        )
    );
}
//Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );    

//Uppsättning av widgets
function mytheme_widget_areas(){
    register_sidebar(
        array(
            'before_tile' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Product Area',
            'id' => 'page-1',
            'description' => 'Home Product Area'
        )
    );
}

add_action('widgets_init', 'mytheme_widget_areas');