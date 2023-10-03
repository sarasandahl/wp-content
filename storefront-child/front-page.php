<?php get_header(); ?>

								<!--- ACF-lösning för front-page --->
								<?php if( get_field('hero_image') ): ?>
    								<img src="<?php the_field('hero_image'); ?>" />
								<?php endif; ?>
								
								<div class="text">
									<?php if( get_field('hero_title') ): ?>
										<h1><?php the_field('hero_title'); ?></h1>
									<?php endif; ?>
									<?php if( get_field('hero_text') ): ?>
										<p><?php the_field('hero_text'); ?></p>
									<?php endif; ?>

<?php get_footer(); ?>