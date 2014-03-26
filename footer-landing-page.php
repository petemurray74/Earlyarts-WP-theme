<?php
/**
 * The template for displaying the footer
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
       
        <?php //reactor_footer_before(); ?>
        
        <footer id="footer" class="site-footer" role="contentinfo">
        <?php
		// get the static footer 
		//get_template_part('footer', 'template'); 
        
		reactor_footer_inside(); ?>
  
        </footer><!-- #footer -->
        
        <?php reactor_footer_after(); ?>

    </div><!-- #main -->
</div><!-- #page -->

<?php wp_footer(); reactor_foot(); ?>

</body>
</html>