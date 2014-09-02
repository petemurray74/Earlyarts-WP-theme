<?php
/**
 * Template Name: Front Page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); ?>
   
        <div id="content" role="main">
        	<div class="row">        
                <div class="<?php reactor_columns(12); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php the_content(); ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
            </div><!-- .row -->
            <div class="row">     
            <?php get_sidebar('frontpage'); ?>
            </div><!-- .row -->            
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>
