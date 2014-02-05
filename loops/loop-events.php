<?php
/**
 * The loop for displaying page content
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */

 //bring in events variables
 global $booking, $wpdb, $wp_query;
?>
 	<?php if ( have_posts() ) : ?>
                        
        <?php reactor_loop_before(); ?>

			<?php while ( have_posts() ) : the_post(); ?>
			   
				<?php reactor_page_before(); ?>      
				<?php // get page content
				get_template_part('post-formats/format', 'event'); ?>
				<?php reactor_page_after(); ?>   
				
			<?php endwhile; // end of the loop ?>
       
	   <?php reactor_loop_after(); ?>
                        
        <?php // if no posts are found
        else : //reactor_loop_else(); ?>
    
    <?php endif; // end have_posts() check ?> 			

	<?php //if ( is_page_template() ) { rewind_posts(); } ?>

