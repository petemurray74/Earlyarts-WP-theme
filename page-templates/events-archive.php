<?php
/**
 * Template Name: Events archive page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @link http://www.catswhocode.com/blog/how-to-create-a-built-in-contact-form-for-your-wordpress-theme
 * @since 1.0.0
 */
?>


<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
        	<div class="row">

                <div class="<?php reactor_columns(); ?>">
					<header class="entry-header">
						<h1 class="entry-title">Events &amp; Training</h1>
					</header>
                <?php reactor_inner_content_before(); ?>
                
					<?php // get the page loop
                   get_template_part('loops/loop', 'events'); ?>
									 
                   <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>