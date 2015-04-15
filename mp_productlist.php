<?php
/**
 * The default template for displaying pages
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
 
 /* the main store page, shows all products */
?>
<?php
// The wrong title was being displayed
function fix_title(){
return "All our Teaching and Training Resources";
}
add_filter('wp_title', 'fix_title', 100);
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
								<h1 class="entry-title">Creative EYFS teaching packs</h1>
								<h3>Based on trusted pedagogical approaches with practical activities that support each child's learning</h3>
                                    <div class="panel callout radius"><strong>Which pack to choose?</strong> 
<a href="http://dm16174grt2cj.cloudfront.net/learning-area-grid-starter-chart.pdf" target="_blank">See how they link to EYFS Areas of Learning &amp; Development</a></div>
								
								</header>
											
									<div class="entry-content">
										<?php 
										// show only products tagged with 'teaching-guides'
										//ea_mp_list_products(true,'','','','','','','teaching-guides'); 
										ea_mp_list_products(true,'','','30','','','','teaching-guides'); 
										?>
                                        <div class="panel"><p><strong>More about <a href="/whats-special/">the packs and what makes them special</a></strong></p></div>
									</div><!-- .entry-content -->
									
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