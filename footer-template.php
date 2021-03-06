
<div id="footer-social">
	<div class="row">
				<div class="large-3 small-12 columns"><a href="http://vimeo.com/earlyarts"><div class="social-sprite vimeo"></div><span>Watch our videos</span></a></div>
				<div class="large-3 small-12 columns"><a href="http://www.facebook.com/earlyartsuk"><div class="social-sprite facebook"></div><span>Join us on facebook</span></a></div>
				<div class="large-3 small-12 columns"><a href="https://twitter.com/#!/earlyartsuk"><div class="social-sprite twitter"></div><span>Follow us on twitter</span></a></div>
				<div class="large-3 small-12 columns"><a href="https://www.linkedin.com/company/earlyarts-uk"><div class="social-sprite linkedin"></div><span>Join us on LinkedIn</span></a></div>	
	</div>
</div>	
<div id="footer-info">
	<div class="row">
	
<div class="row" id="footer">
	<div class="large-4 small-12 columns">
		<h3>About Earlyarts</h3>
		<p>Earlyarts is the award winning, national network for early childhood educators who believe in nurturing their children's creative potential.<br>
		<a href="/about-us">More about us</a> &raquo;</p>
		<p>General enquiries:<br>
		info@earlyarts.co.uk<br>
		or call 01484 685869</p>
		<p><a href="/about-us/contact-us/">Contact us</a> &raquo;<br>
		<a href="/about-us/terms-conditions/">Terms and conditions</a> &raquo;</p>
	</div>
	<div class="large-4 small-12 columns">
	<h3>What people say</h3>
	
    <?php 
$args=array('post_type'=>'testimonials', 'orderby'=>'rand', 'posts_per_page'=>'1');
$testimonials=new WP_Query($args); 

while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
                <div class="lcp_article">
                <p class="lcp_post_title_no_space"><?php the_title(); ?></p>
                    <div class="testimonial"><div class="quote_start">&#8220;</div><?php the_content();?><div class="quote_end">&#8221;</div>
                    </div>
                </div>
 <?php endwhile; wp_reset_postdata(); ?>    
		
	</div>
</div>




	
	</div>
</div>

