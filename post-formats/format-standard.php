<?php
/**
 * The template for displaying post content
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-body">
            
            <header class="entry-header">
            	<?php 
				if (is_singular('incsub_event')) {?><h1 class="entry-title"><?php the_title();?></h1><?php }
				else {reactor_post_header();}	?>
            </header><!-- .entry-header -->
			
            <?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
            <?php elseif ( is_single() ) : ?>
			<div class="entry-content">
				<?php the_content(); ?>
                <?php wp_link_pages( array('before' => '<div class="page-links">' . __('Pages:', 'reactor'), 'after' => '</div>') ); ?>
            </div><!-- .entry-content --> 
            <?php else : ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->
            <?php endif; ?>
    
            <footer class="entry-footer">
            	<?php 
				//no meta on post 160 (thanks for subscribing)
				if (!is_single(160)) { 
				reactor_post_footer(); } ?>
            </footer><!-- .entry-footer -->
        </div><!-- .entry-body -->
	</article><!-- #post -->