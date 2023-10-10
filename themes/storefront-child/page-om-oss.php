<?php get_header();

$about_title = get_field('about_us_tile');
$about_text = get_field('about_us_text');
$about_number = get_field('our_number');
$about_email = get_field('customer_support_email');
$about_image = get_field('about_image')
?>

<!--- ACF-lösning för Om Oss-sida --->
<div id="container-about-us">
        <div class="left-text">

            <?php if($about_title): ?>
                <h1><?php echo $about_title; ?></h1>
            <?php endif; ?>

            <?php if($about_text): ?>
                <p><?php echo nl2br($about_text); ?></p>
            <?php endif; ?>

            <?php if($about_number): ?>
                <p><?php echo (int)$about_number; ?></p>
            <?php endif; ?>

            <?php if($about_email): ?>
                <a href="mailto:<?php echo $about_email; ?>"><?php echo $about_email; ?></a>
            <?php endif; ?>

        </div>
        
        <div class="right-image">

            <?php if($about_image): ?>
                <img src="<?php echo $about_image ?>"/>
            <?php endif; ?>

        </div>
</div>

<!--- Outputtar CPT-lösning för Butiker --->
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