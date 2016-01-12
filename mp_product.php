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
					
                    //look for Product Tags and returning a specific Price: text
                    $pre_text='Price:<br> ';
                    $the_product_tags = get_the_terms($thisProdId,'product_tag');
                    if ( $the_product_tags && ! is_wp_error( $the_product_tags ) ) : 

                        $product_tag_name = array();

                        foreach ( $the_product_tags as $the_product_tag ) {
                            $product_tag_name[] = $the_product_tag->name;
                        }
                   endif;
                    if (in_array('PDF-download', $product_tag_name))
                    {$pre_text='PDF version:<br>';}
                    ?>

					<?php reactor_page_before(); ?> 
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-body">
						
							<?php reactor_page_header(); ?>
							<style type="text/css">
							.mp_product_price {
                            font-size:130%;    
							}		
							</style>
							<div class="entry-content">						
                                <div class="row">
                                    <div class="column large-5 push-7 small-12">
                                        <?php 
                                        mp_product_image($thisProdId); 
                                       
                                        ?>
                                    </div> 
									<section id="mp-single-product" itemscope itemtype="http://schema.org/Product">
										<div class="mp_product mp_single_product column large-7 pull-5 small-12">
                                    <p class="product-excerpt">
                                    <?php
                                    //show the excerpt
                                    echo (get_the_excerpt());
                                    ?></p>
                                     <div class="panel" style="border:none;">
                                     <div class="row" style="background:none;">
                                      <div class="column large-6 small-12">
                                <span class="preprice"><?php echo ($pre_text); ?></span>
                                <?php
                                mp_product_price(true,$thisProdId,'');
                               //MPUPGRADE if (current_user_on_level(5)) {echo '<div class="ea_mp_discount_price">Your 10% member discount will be applied in the checkout</div>';}
                                ?>
                                </div><div class="column large-6 small-12">
								<?php echo do_shortcode( '[mp_buy_button product_id="'.$thisProdId.'" context="single"]') ?>
                                </div></div></div>              
                                <?php   
                                //MPUPGRADE mp_product_description($thisProdId);
								?>
								<?php mp_product_description($thisProdId) ?>
                                     
                                    </div>  
								</section>				
  
                                    
                                </div>
								
							</div><!-- .entry-content -->
							
							<footer class="entry-footer">
								<?php reactor_page_footer(); ?>
							</footer><!-- .entry-footer -->
							
						</div><!-- .entry-body -->
					</article><!-- #post -->
				<?php reactor_page_after(); ?> 	
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar('store'); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>