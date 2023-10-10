<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

            <div id="footer-container">
                <div id="stores-location-box">
                <!--- Outputtar CPT-lösning för Butiker --->
                <?php
                $loop = new WP_Query(
                array(
                    'post_type' => 'butiker',
                    'posts_per_page' => 50
                )
                );
                while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <h2><?php the_title(); ?></h2>
                <p><?php the_content(); ?></p>

                <?php endwhile;
                wp_reset_postdata();?>
                </div>

                <div>
                <?php
                /**
                * Functions hooked in to storefront_footer action
                *
                * @hooked storefront_footer_widgets - 10
                * @hooked storefront_credit         - 20
                */
                do_action( 'storefront_footer' );
                ?>
                </div>
            </div>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>