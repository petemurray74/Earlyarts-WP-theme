<?php
/**
 * The template for displaying the link post format
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>        
        <div class="entry-body">

            <header class="entry-header">
            	<?php reactor_post_header(); ?>
            </header><!-- .entry-header -->
            
            <div class="entry-content">
                
				<div class="post-format-link-title">
                    <a href="<?php //we are using excerpt to hold the URL
					echo(strip_tags(get_the_excerpt()));
					?>" target="_new"><?php the_title(); ?></a> 
                </div>
				
				<div class="post-format-link-txt">
                    <?php the_content(); ?>
                </div>
                			
				</div><!-- .entry-content -->
                
        </div><!-- .entry-body -->
	</article><!-- #post -->