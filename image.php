<?php
/**
 * The template for displaying image attachments
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
                
				<?php while ( have_posts() ) : the_post(); ?>
        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('image-attachment'); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
        
                            </header><!-- .entry-header -->
        
                            <div class="entry-content">  
        
                                <div class="entry-description">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages( array('before' => '<div class="page-links">' . __('Pages:', 'reactor'), 'after' => '</div>') ); ?>
                                </div><!-- .entry-description -->
								
								<div class="entry-attachment">
                                    <div class="attachment">

                                        <a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
                                        $attachment_size = apply_filters('reactor_attachment_size', array( 960, 960 ) );
                                        echo wp_get_attachment_image( $post->ID, $attachment_size );
                                        ?></a>
        
                                        <?php if ( !empty( $post->post_excerpt ) ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div><!-- .attachment -->
        
                                </div><!-- .entry-attachment -->
                                <footer class="entry-meta"><p>
                                    <?php
                                        $metadata = wp_get_attachment_metadata();
                                        printf( __('<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a>.', 'reactor'),
                                            esc_attr( get_the_date('c') ),
                                            esc_html( get_the_date() ),
                                            esc_url( wp_get_attachment_url() ),
                                            $metadata['width'],
                                            $metadata['height']
                                        );
                                    ?>
                                    <?php edit_post_link( __('Edit', 'reactor'), '<span class="edit-link">', '</span>'); ?>
                                </p></footer><!-- .entry-meta -->
		
                            </div><!-- .entry-content -->
        
                        </article><!-- #post -->
        
                        <?php comments_template(); ?>
        
                    <?php endwhile; // end of the loop ?>
                    
                    <?php reactor_inner_content_after(); ?>
                    
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>