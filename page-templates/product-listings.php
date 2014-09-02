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
                <div class="<?php reactor_columns(); ?>">
                
                <?php reactor_inner_content_before(); ?>
					   
						<?php reactor_page_before(); ?>
									  
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-body">
                                <header class="entry-header">
                                    <?php reactor_page_header();
                                    if ($cat_description=get_post_meta($post->ID,'category_description',true)){
                                    echo ('<p>'.$cat_description).'</p>'; }
                                    ?>
								</header>	
									<div class="entry-content">
										<?php 								
                                        /* GET category to display from custom fields - use the slug, not the ID */
                                        if ($cat=get_post_meta($post->ID,'show_category',true)){   
										// show only products tagged with 'teaching-guides'
										//ea_mp_list_products(true,'','','','','','','teaching-guides'); 
										ea_mp_list_products(true,'','','','','',$cat,'teaching-guides'); 
										?>
										<?php the_content(); ?>
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
	
					<?php // mp_cart_link(true,false, 'View shopping basket &raquo;');?>

					<?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar('store'); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>