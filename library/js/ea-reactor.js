/* Reactor - Anthony Wilhelm - http://awtheme.com/ */
( function($) {

  $(document).ready( function() {
	
    /* adds .button class to submit button on comment form */
    $('#commentform input#submit').addClass('button').addClass('small');
  
    /* adjust site for fixed top-bar with wp admin bar */
    if($('body').hasClass('admin-bar')) {
    	if($('.top-bar').parent().hasClass('fixed')) {
    		
		if($('body').hasClass('has-top-bar')) {
	    	    $('.top-bar').parent().css('margin-top', "+=28");
		}
		
		$('body').css('padding-top', "+=28");
	}
    }

    /* prevent default if menu links are # */
    $('nav a').each(function() {
        var nav = $(this); 
        if(nav.attr('href') == '#') {
            $(this).on('click', function(e){ 
                e.preventDefault();
            });
        }
    });

    /* MixItUp - http://mixitup.io/ */
    if($().mixitup) {
        $(function(){
            $('#Grid').mixitup();
        });
    }
	
  }); /* end $(document).ready */

	/* Off Canvas - http://www.zurb.com/playground/off-canvas-layouts */
	events = 'click.fndtn';
	var $selector = $('#mobileMenuButton');
	if ($selector.length > 0) {
		$('#mobileMenuButton').on(events, function(e) {
			e.preventDefault();
			$('body').toggleClass('active');
		});
	}
	
	$(document).foundation('orbit', {
	  animation: 'fade',
	  timer_speed: 3000,
	  pause_on_hover: true,
	  resume_on_mouseout: true,
	  animation_speed: 1000,
	  stack_on_small: true,
	  navigation_arrows: false,
	  slide_number: true,
	  container_class: 'orbit-container',
	  stack_on_small_class: 'orbit-stack-on-small',
	  next_class: 'orbit-next',
	  prev_class: 'orbit-prev',
	  timer_container_class: 'orbit-timer',
	  timer_paused_class: 'paused',
	  timer_progress_class: 'orbit-progress',
	  slides_container_class: 'orbit-slides-container',
	  bullets_container_class: 'orbit-bullets',
	  bullets_active_class: 'active',
	  slide_number_class: 'orbit-slide-number',
	  caption_class: 'orbit-caption',
	  active_slide_class: 'active',
	  orbit_transition_class: 'orbit-transitioning',
	  bullets: true,
	  timer: true,
	  variable_height: false,
	  before_slide_change: function(){},
	  after_slide_change: function(){}
	});	
	
	/* Initialize Foundation Scripts */
	$(document).foundation();

})( jQuery );	
