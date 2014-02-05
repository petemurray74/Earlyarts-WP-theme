<?php
/**
 * The template for displaying events
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-body">
            
            	<?php // reactor_page_header(); ?>
                        
                <div class="entry-content">
					 <div class="event <?php echo Eab_Template::get_status_class($post); ?>">
                            <div class="wpmudevevents-header">
                                <h2><a href="<?php the_permalink(); ?>"><?php echo Eab_Template::get_event_link($post); ?></a></h2>
                            </div>
							<?php
                                echo Eab_Template::get_event_details($post);
                            ?>
                        </div>
				</div><!-- .entry-content -->
                
                <footer class="entry-footer">
					<?php //reactor_page_footer(); ?>
                </footer><!-- .entry-footer -->
                
            </div><!-- .entry-body -->
        </article><!-- #post -->