<?php
/**
 * Template Name: Front Page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>

<?php // get the options
$slider_category = reactor_option('frontpage_slider_category', ''); ?>

<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); 
		// slider code removed from here, see original for code.
		?>
   
        <div id="content" role="main">
        	<div class="row">        
                <div class="<?php reactor_columns(); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // get the page loop
                    get_template_part('loops/loop', 'page'); ?>
                        
					<?php // get the main loop
					//get_template_part('loops/loop', 'frontpage'); ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->

				<?php get_sidebar('frontpage'); ?>
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>
