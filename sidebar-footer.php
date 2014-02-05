<?php 
/**
 * The sidebar template containing the footer widget area
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

		<?php if ( is_active_sidebar('sidebar-footer') ) : ?>
            <div class="inner-footer">
				<div class="row">
                    <div id="sidebar-footer" class="sidebar" role="complementary">
                      <?php dynamic_sidebar('sidebar-footer'); ?>
                    </div><!-- #sidebar-footer -->
				</div><!-- .row -->			
			</div><!--.inner-footer -->  
		<?php endif; ?>