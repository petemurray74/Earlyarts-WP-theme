<?php
/**
 * The template for cart and checkout pages
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
				
					<?php  
					$thisProdId=get_the_ID();?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
						<div class="entry-body">
						
							<?php reactor_page_header(); ?>
							<header class="entry-header">
                            <h1 class="entry-title"><?php echo ($mp->wp_title_output());?></h1>
                            
                            </header>
							<div class="entry-content">
                                  <?php mp_show_cart('checkout'); ?>
								
							</div><!-- .entry-content -->
							
							<footer class="entry-footer">
								<?php reactor_page_footer(); ?>
							</footer><!-- .entry-footer -->
							
						</div><!-- .entry-body -->
					</article><!-- #post -->
				<?php reactor_page_after(); ?> 	
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>