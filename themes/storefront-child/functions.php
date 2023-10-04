<?php 

//menyer
function mytheme_menus(){
    $locations = array(
        'footer' => "Footer Menu"
    );

    register_nav_menus($locations);
}

add_action('init','mytheme_menus');