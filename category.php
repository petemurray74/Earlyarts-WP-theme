<?php
/**
 * The template for displaying posts by category
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
                
				<?php if ( have_posts() ) : ?>
                    <header class="archive-header">                   
        
                    <?php // show category description if there is one, else the title 
					if ( category_description() ) : ?>
						<h1 class="archive-title"><?php printf( __('%s', 'reactor'), '<span>' . single_cat_title( '', false ) . '</span>'); ?></h1><?php echo wpautop(category_description()) ?>
					<?php else:?>
						<h1 class="archive-title"><?php printf( __('%s', 'reactor'), '<span>' . single_cat_title( '', false ) . '</span>'); ?></h1>
                    <?php endif; ?>
                    </header><!-- .archive-header -->
                <?php endif; // end have_posts() check ?> 
                
				<?php // get the loop
				// checks to see whether this is a category which should be date ordered
				// i.e news,blogs,media coverage
				if (is_category(array(19,43,18))) 
				{
				get_template_part('loops/loop', 'index'); 
                }
				else
				{
				// alter the default query to sort by title
				// from http://codex.wordpress.org/Function_Reference/query_posts
				global $query_string;
				query_posts( $query_string . '&order=ASC&orderby=title' );
				get_template_part('loops/loop', 'index'); 
				}
				?>
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>