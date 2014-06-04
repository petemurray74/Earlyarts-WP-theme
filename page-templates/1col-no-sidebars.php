<?php
/**
 * Template Name: One Col
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="landing-page1" class="site-content">
    <?php remove_action('reactor_content_before', 'earlyarts_hero_image', 5); ?>
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // start the loop
                    while ( have_posts() ) : the_post(); ?>
                    
                    <?php reactor_post_before(); ?>
					<article <?php post_class(); ?>>
						<div class="entry-body">
							<div class="entry-content">   
					<?php the_content(); ?>
							</div>
						</div>
					</article>			
                    <?php 
					reactor_post_after(); 
					endwhile; // end of the loop
                    reactor_inner_content_after(); 
					?>
                
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>