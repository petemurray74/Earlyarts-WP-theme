<?php
/**
 * Template Name: Front Page
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
                <div class="<?php reactor_columns(12); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // the_content(); ?>
                    <?php reactor_inner_content_after(); ?>
 
                

                    
<!---------------------- MOVE THIS TO AN INC ------------------------------------------------------->
   
            <h1>Creative teaching and training resources for the EYFS</h1>
            <ul class="small-block-grid-2 large-block-grid-4 photo-blocks">        
                <li>
                    <a href="/topic/natural-recycled-materials/" class="photo-box-link">
                    <div class="photo-box natural">
                    <img src="/wp-content/themes/earlyarts/images/home-categories/natural1.jpg">          
                    <div class="photo-box-caption">
                    Natural &amp; Recycled    
                    </div>  
                    </div>
                    </a>    
                </li>
                <li>
                    <a href="/topic/music-singing/" class="photo-box-link">
                    <div class="photo-box">
                    <img src="/wp-content/themes/earlyarts/images/home-categories/music1.jpg">    
                    <div class="photo-box-caption">
                    Music &amp; Singing    
                    </div>
                    </div>
                    </a>  
                </li>
                <li>
                    <a href="/topic/crafts-construction/" class="photo-box-link">
                    <div class="photo-box">
                    <img src="/wp-content/themes/earlyarts/images/home-categories/crafts1.jpg">
                    <div class="photo-box-caption">
                    Crafts & Construction   
                    </div>                     
                    </div>   
                    </a>  
                </li>
                <li>
                    <a href="/topic/photography-video/" class="photo-box-link">
                    <div class="photo-box">
                    <img src="/wp-content/themes/earlyarts/images/home-categories/photography1.jpg">
                    <div class="photo-box-caption">
                     Video & Photography  
                    </div>                     
                    </div>      
                    </a>  
                </li>
            </ul> 
    
           <ul class="small-block-grid-2 large-block-grid-4">        
                <li>
                    <a href="/topic/drawing-writing-mark-making/" class="photo-box-link">
                    <div class="photo-box">
                    <img src="/wp-content/themes/earlyarts/images/home-categories/drawing1.jpg"> 
                    <div class="photo-box-caption">
                     Drawing  & Mark Making 
                    </div>                     
                    </div>    
                    </a>  
                </li>
                <li>
                    <a href="/topic/storytelling-puppets-roleplay/" class="photo-box-link">
                    <div class="photo-box">
                    <img src="/wp-content/themes/earlyarts/images/home-categories/puppets1.jpg">
                    <div class="photo-box-caption">
                      Puppets & Story Telling   
                    </div>                     
                    </div>   
                    </a>  
                </li>
                <li>
                    <a href="/topic/movement-dance/" class="photo-box-link">
                    <div class="photo-box">
                   <img src="http://lorempixel.com/349/209/abstract/8">
                    <div class="photo-box-caption">
                     Dance & Movement    
                    </div>                     
                    </div>     
                    </a>  
                </li>
                <li>
                    <a href="#" class="photo-box-link">
                    <div class="photo-box">
                  <img src="http://lorempixel.com/349/209/abstract/10">
                    <div class="photo-box-caption">
                    SPECIAL OFFER
                    </div>                     
                    </div>   
                    </a>  
                </li>
            </ul>                  
            
                    
                    
                    
<!---------------------- MOVE THIS TO AN INC ------------------------------------------------------->                    
                </div><!-- .columns -->
            </div><!-- .row -->         

            <div class="row">
                <ul class="small-block-grid-1 large-block-grid-2 content-foot-block">
                    <li><h2>Join us for a 10% Discount</h2>
                    <p>As an Earlyarts member, you'll receive
                    </p>
                    <ul>
                    <li>10% off all products</li>
                    <li>Free training webinars</li>
                    <li>Exclusive teaching pack extracts</li></ul>
                    <p><a class="radius success button" href="/subscribe-to-earlyarts/">Join us</a></p>
                    </li>
                    <li>
                    <h2>Free Early Years Bulletin</h2>
                    <p>Every month we choose you the best and most relevant links</p>
                        <ul>
                        <li>Training opportunities</li>
                        <li>Relevant resources</li>
                        <li>New research</li>
                        </ul>
                    <p><a class="radius success button" href="/subscribe-e-bulletin/">Get the e-bulletin</a></p></li>
                </ul> 
            <?php get_sidebar('frontpage'); ?>
            </div><!-- .row -->            
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>
