<?php
/**
 * The default template for displaying pages
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
		
					   
						<?php reactor_page_before(); ?>
									  
						<?php // get page content ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-body">
								    <header class="entry-header">
										<h1 class="entry-title"><?php single_cat_title(); ?></h1>
									</header><!-- .entry-header -->
									<?php // reactor_page_header(); ?>
									<?php echo category_description(); ?>
									<div class="entry-content">
										<?php ea_mp_list_products(); ?>
									</div><!-- .entry-content -->
									
									<footer class="entry-footer">
										<?php reactor_page_footer(); ?>
									</footer><!-- .entry-footer -->
									
								</div><!-- .entry-body -->
							</article><!-- #post -->

						<?php reactor_page_after(); ?>   
        

					<?php if ( is_page_template() ) { rewind_posts(); } ?>

					<?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar('store'); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>