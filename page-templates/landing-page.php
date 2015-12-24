<?php
/**
 * Template Name: Landing Page 1
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
if (get_post_meta($post->ID,'include_sidebar',true)=='yes')
    {
    if (is_active_sidebar('primary-generic')) : 
    ?>
    <div class="row">
    <div id="secondary" class="large-12 columns primary-generic-sidebar">
    <?php
    dynamic_sidebar('primary-generic'); 
    endif;
    ?>
    </div></div>  
        </div><!-- #primary -->
    <?php
    }
   
	get_footer('landing-page'); 
?>
        
	


