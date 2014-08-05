<?php
/**
 * Template Name: One Col
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>

<?php get_template_part('page-templates/meta-controls');?>
<?php get_header(); ?> 

	<div id="primary" class="site-content">
        <div class="row">
            <div class="large-12 small-12 columns">
               
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // start the loop
                    while ( have_posts() ) : the_post(); ?>
                    
                    <?php reactor_post_before(); ?>
					<article <?php post_class(); ?>>
                        <div class="entry-body">
						    <header class="entry-header"> 
								<h1 class="entry-title"><?php the_title();?></h1>
							</header><!-- .entry-header -->
							<div class="entry-content">   
					<?php the_content(); ?>
							</div>
						</div>
					</article>			
                    <?php 
					reactor_post_after(); 
					endwhile; // end of the loop
                    reactor_inner_content_after(); 
					?>
                
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
                </div><!-- .columns -->
        </div><!-- .row -->
	</div><!-- #primary -->

<?php get_footer(); ?>