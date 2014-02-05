<?php 
/**
 * The sidebar template for product/store pages
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

   <?php reactor_sidebar_before(); ?>
    
   		<?php if ( is_active_sidebar('sidebar-store') ) : ?>
            <div id="sidebar" class="sidebar <?php reactor_columns( '', true, true, 1 ); ?>" role="complementary">
				<div class="primary-sidebar">
					<?php dynamic_sidebar('sidebar-store'); ?>
                </div><!-- .primary-sidebar -->		
			</div><!-- #sidebar -->  
		<?php endif; ?>
		
	<?php reactor_sidebar_after(); ?>  