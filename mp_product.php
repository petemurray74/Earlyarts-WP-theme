<?php
/**
 * The template for displaying individual products
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
				
					<?php // get the page loop
                    //get_template_part('loops/loop', 'page'); 
					$thisProdId=get_the_ID();
					?>
					<?php reactor_page_before(); ?> 
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-body">
						
							<?php reactor_page_header(); ?>
							<style type="text/css">
							.mp_product_price {
							line-height: 40px;
							background: none;
							margin-right: 0px;
							padding:0;
							}		
							</style>
							<div class="entry-content">
								<?php //the_content(); 
								mp_product_image($thisProdId);
								mp_product_description($thisProdId);
								mp_product_price($thisProdId);
								mp_buy_button(true,'single',$thisProdId);
								if (current_user_on_level(5)) {echo '&nbsp;<div class="success radius label ea_mp_discount_price">Your 10% member discount will be applied in the checkout</div>';}
								?>
							</div><!-- .entry-content -->
							
							<footer class="entry-footer">
								<?php reactor_page_footer(); ?>
							</footer><!-- .entry-footer -->
							
						</div><!-- .entry-body -->
					</article><!-- #post -->
				<?php reactor_page_after(); ?> 	
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>