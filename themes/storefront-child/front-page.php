<?php get_header(); ?>

<main>
			<section>
				<div class="container"> <!--- boostrap --->
					<div class="row"> <!--- boostrap --->
						<div class="col-xs-12"> <!--- boostrap --->
							<div class="hero"> <!--- css --->

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
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>
		</main>

<?php get_footer(); ?>