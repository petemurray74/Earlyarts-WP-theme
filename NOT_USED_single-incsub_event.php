<?php
/**
 * The template for displaying all single events (incsub-event)
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
        	<div class="row">
                <div class="<?php reactor_columns(); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // start the loop
                    while ( have_posts() ) : the_post(); ?>
                    
                    <?php reactor_post_before(); ?>
                        
					<?php // display code for that events format 
					//get_template_part('post-formats/format', 'standard'); ?>
                    
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-body">
								
								<header class="entry-header">
									<?php reactor_post_header(); ?>
								</header><!-- .entry-header -->					
<div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>
								<div class="entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->
						
								<footer class="entry-footer">
									<?php reactor_post_footer(); ?>
								</footer><!-- .entry-footer -->
							</div><!-- .entry-body -->
						</article><!-- #post -->
					
					
					
                    <?php reactor_post_after(); ?>
        
                    <?php endwhile; // end of the loop ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>