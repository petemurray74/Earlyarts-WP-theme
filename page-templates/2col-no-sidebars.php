<?php
/**
 * Template Name: Two Col - No sidebars
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
                
                </div><!-- .columns -->
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>