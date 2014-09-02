<?php
/**
 * The sidebar template containing the front page widget area
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

	<?php
    wp_reset_postdata();  
    reactor_sidebar_before();
    if ( is_active_sidebar('sidebar-frontpage')) : 
?>
        <div id="sidebar-frontpage" class="sidebar <?php reactor_columns( 6 ); ?>" role="complementary">
            <?php dynamic_sidebar('sidebar-frontpage'); ?>
        </div><!-- #sidebar-frontpage -->
    <?php endif; ?>

    <?php reactor_sidebar_after(); ?>
    

    <?php 
    reactor_sidebar_before();    
    if ( is_active_sidebar('sidebar-frontpage-2')) : 
     ?>
    
        <div id="sidebar-frontpage-2" class="sidebar <?php reactor_columns( 6 ); ?>" role="complementary">
            <?php dynamic_sidebar('sidebar-frontpage-2'); ?>
        </div><!-- #sidebar-frontpage-2 -->    
    <?php endif; ?>
    <?php reactor_sidebar_after(); ?>