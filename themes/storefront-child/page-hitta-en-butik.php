<?php get_header(); ?>

    <?php
    $loop = new WP_Query(
    array(
        'post_type' => 'butiker',
        'posts_per_page' => 50
    )
    );
    while ( $loop->have_posts() ) : $loop->the_post();

    ?>

    <h2><?php the_title(); ?></h2>

    <?php endwhile;
        wp_reset_postdata();
    ?>

<?php get_footer(); ?>