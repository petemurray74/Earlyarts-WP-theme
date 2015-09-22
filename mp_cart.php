<?php
/**
 * The template for all cart pages Review Cart, Shipping, Checkout, Confirm,Order Complete
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
                 
                        <div class="entry-body">

                            <header class="entry-header">
                                <h1 class="entry-title"><?php wp_title(''); ?></h1>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php //MPUPGRADE mp_show_cart('checkout'); ?>
                            </div><!-- .entry-content -->

                            <footer class="entry-footer">
                                <?php reactor_page_footer(); ?>
                            </footer><!-- .entry-footer -->

                        </div><!-- .entry-body -->

                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php //get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>