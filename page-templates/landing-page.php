<?php
/**
 * Template Name: Landing Page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>

<?php get_header('landing-page'); ?>

	<div id="primary" class="site-content">
    
    	<?php //reactor_content_before(); ?>
   
        <div id="content" role="main">
        	<div class="row">        
                <div class="<?php reactor_columns(12); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php reactor_page_before(); ?>
					
					<article id="post-<?php echo $page_id; ?>" class="<?php echo $class; ?>">   
																
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article><!-- #post -->
					
					<?php reactor_page_after(); ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->

            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer('landing-page'); ?>
