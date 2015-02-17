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
								<h1 class="entry-title">All Teaching Packs</h1>
								<h3>Our creative EYFS teaching packs are based on trusted pedagogical approaches highlighting activities that support each child's learning.</h3>
								<p><strong>More about <a href="/whats-special/">the packs and what makes them special</a></strong></p>
								</header>
											
									<div class="entry-content">
										<?php 
										// show only products tagged with 'teaching-guides'
										//ea_mp_list_products(true,'','','','','','','teaching-guides'); 
										ea_mp_list_products(true,'','','','','','','teaching-guides'); 
										?>
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