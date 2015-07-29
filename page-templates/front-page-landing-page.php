<?php
/**
 * Template Name: Front Page Landing Page 
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>
<?php get_template_part('page-templates/meta-controls');?>
<?php get_header(); ?>

	<div id="primary" class="landing-page1">
    
    	<?php //reactor_content_before(); ?>
   
        <div id="content" role="main">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php reactor_page_before(); ?>
					
					<article id="post-<?php echo $page_id; ?>" class="<?php echo $class; ?>">   
																
						<div class="entry-content"><h1>WAZZ</h1>
							<?php the_content(); ?>
						</div>
					</article><!-- #post -->
					
					<?php reactor_page_after(); ?>
                    
                <?php reactor_inner_content_after(); ?>
                

        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
<?php 
    if (is_active_sidebar('sidebar-frontpage')) : 
    ?>
    <div class="row">
    <div id="secondary" class="frontpage-sidebar">
    <?php
    dynamic_sidebar('sidebar-frontpage'); 
    endif;
    ?>
    </div></div>  
       
    <?php

// this Javascript takes variable from a query string and adds them to a form as hidden fields
// from http://www.terminusapp.com/blog/bet-you-havent-used-utm-parameters-like-this
// use 'utm_' fields for external links, so they also show on Analytics
// use 'source' for internal

if (get_post_meta($post->ID,'include_tracking_code',true)=='yes')
{
?>
<script type="text/javascript">
  function setupUtmParamForm() {
    function getParameterByName(name) {
      name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
      var regexS = "[\\?&#038;]" + name + "=([^&#]*)";
      var regex = new RegExp(regexS);
      var results = regex.exec(window.location.search);
      if(results == null) {
        return "";
      } else {
        return decodeURIComponent(results[1].replace(/\+/g, " "));
      }
    }
    jQuery(document).ready(function () {
      function addFormElem(paramName, fieldName) {
        var paramValue = getParameterByName(paramName);
        var $utmEl = jQuery("<input type='hidden' name='" + fieldName + "' value='" + paramValue + "'>");
        if (paramValue != "") {
          jQuery("form").first().prepend($utmEl);
        }
      }
 
      var utmParams = {
        "utm_source"   : "USOURCE",
        "utm_medium"   : "UMEDIUM",
        "utm_campaign" : "UCAMPAIGN",
        "source"       : "MMERGE3"
      };
 
      for (var param in utmParams) {
        addFormElem(param, utmParams[param]);
      }
    });
  }
setupUtmParamForm();
</script>
</div><!-- #primary -->
<?php    
} // end mailchimp tracking code
get_footer();
?>

        
	


