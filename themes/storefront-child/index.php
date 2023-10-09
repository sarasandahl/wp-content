<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <h1><?php wp_title(''); ?></h1>
					<!--- the loop för posts i blogg--->
                    <?php 
                        if( have_posts()) {
                            while( have_posts()) {
                                the_post(); ?>
            
                                <article>
                                    
                                    <h2 class="title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <?php the_post_thumbnail(); ?>
                                    <ul class="meta">
                                        <li>
                                            <i class="fa fa-calendar"></i> <?php the_date('j F, Y'); ?>
                                        </li>
                                        <li>
                                            <i class="fa fa-user"></i> <a href=""><?php the_author(); ?></a>
                                        </li>
                                        <li>
                                            <?php the_tags('<i class="fa fa-tag"></i>'); ?>
                                        </li>
                                    </ul>
                                    <p><?php the_excerpt(); ?></p>
                                </article>
                        
                                <?php
                            }
                        }
                    ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();