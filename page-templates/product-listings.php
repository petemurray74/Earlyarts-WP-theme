<?php
/**
 * Template Name: Product List
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
                <div class="<?php reactor_columns(9); ?>">
                        <?php reactor_page_header();
                        if ($cat_description=get_post_meta($post->ID,'category_description',true)){
                        echo ('<p>'.$cat_description).'</p>'; 
                        } ?>	
                </div>
                <div class="<?php reactor_columns(3); ?>">
                    <div class="ea-mp-order-area"><div class="ea-mp-view-cart"><a class="small button" href="/store/shopping-cart/" title="Go To Checkout Page">View shopping cart</a></div><div class="ea-mp-view-order-status"><a class="small button" href="/store/order-status/" title="Your previous and current orders">Your recent orders</a></div></div>
                </div>
            </div>    
        	<div class="row">
                <div class="<?php reactor_columns(12); ?>">
                
                <?php reactor_inner_content_before(); ?>
					   
						<?php reactor_page_before(); ?>
									  
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-body">
									<div class="entry-content">
										<?php 								
                                        /* GET category to display from custom fields - use the slug, not the ID */
                                        if ($cat=get_post_meta($post->ID,'show_category',true)){   
										// show only products tagged with 'teaching-guides'
										//ea_mp_list_products(true,'','','','','','','teaching-guides'); 
										ea_mp_list_products(true,'','','','','',$cat,'teaching-guides'); 
										?>
										<div class="ea-mp-list-page-body">
										<?php the_content(); ?>
										</div>
									</div><!-- .entry-content -->
                                    <?php
                                    }
                                    else {echo('Please supply a category to display');}
                                    ?>
									<footer class="entry-footer">
										<?php reactor_page_footer(); ?>
									</footer><!-- .entry-footer -->
									
								</div><!-- .entry-body -->
							</article><!-- #post -->

						<?php reactor_page_after(); ?>   
        

					<?php if ( is_page_template() ) { rewind_posts(); } ?>

					<?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
               
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>