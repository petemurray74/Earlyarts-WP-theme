<?php
/**
 * The template for displaying attachments
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
                        
					<h1 class="entry-title"><?php the_title();?></h1>
					<?php
					the_content();
					echo ('&raquo; Download: '.wp_get_attachment_link());
                    
                    //reactor_post_after();
        
                    endwhile; // end of the loop 
                    
					reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>