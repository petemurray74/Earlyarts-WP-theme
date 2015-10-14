<?php
/**
 * Template Name: Front Page Landing Page 
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>
<?php get_template_part('page-templates/meta-controls');?>
<?php get_header(); ?>

	<div id="primary" class="landing-page1">
    
    	<?php //reactor_content_before(); ?>
   
        <div id="content" role="main">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php reactor_page_before(); ?>
					
					<article id="post-<?php echo $page_id; ?>" class="<?php echo $class; ?>">   
																
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article><!-- #post -->
					
					<?php reactor_page_after(); ?>
                    
                <?php reactor_inner_content_after(); ?>
                

        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
<?php 
    if (is_active_sidebar('sidebar-frontpage')) : 
    ?>
    <div class="row">
    <div id="secondary" class="frontpage-sidebar">
    <?php
    dynamic_sidebar('sidebar-frontpage'); 
    endif;
    ?>
    </div></div>  
       

	</div><!-- #primary -->
<?php    
get_footer();
?>

        
	


