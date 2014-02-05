<?php
/**
 * The template for displaying the quote post format
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>        
        <div class="entry-body">
            
            <div class="entry-content">
			<h4><?php the_title(); ?></h4>
            	<?php // blockquote tags are automatically added
                  	the_content(); ?>
            </div><!-- .entry-content -->

        </div><!-- .entry-body -->
	</article><!-- #post -->
