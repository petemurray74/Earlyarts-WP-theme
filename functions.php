<?php
/**
 * Reactor Child Theme Functions
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @version 1.1.0
 * @since 1.0.0
 * @copyright Copyright (c) 2013, Anthony Wilhelm
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/* -------------------------------------------------------
 You can add your custom functions below
-------------------------------------------------------- */


/**
 * Child Theme Features
 * The following function will allow you to remove features included with Reactor
 *
 * Remove the comment slashes (//) next to the functions
 * For add_theme_support, remove values from arrays to disable parts of the feature
 * remove_theme_support will disable the feature entirely
 * Reference the functions.php file in Reactor for add_theme_support functions
 */
add_action('after_setup_theme', 'reactor_child_theme_setup', 11);

function reactor_child_theme_setup() {

    /* Support for menus */
	//remove_theme_support('reactor-menus');
	//add_theme_support('reactor-menus',array('side-menu', 'footer-links') );
	
	/* Support for sidebars
	Note: this doesn't change layout options */
	// remove_theme_support('reactor-sidebars');
	 add_theme_support(	'reactor-sidebars',array('primary', 'secondary', 'front-primary', 'front-secondary','front-tertiary','primary-generic' ,'footer','store') );
	
	/* Support for layouts
	Note: this doesn't remove sidebars */
	// remove_theme_support('reactor-layouts');
	// add_theme_support(
	// 	'reactor-layouts',
	// 	array('1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c')
	// );
	
	/* Support for custom post types */
	remove_theme_support('reactor-post-types');
	//add_theme_support('reactor-post-types',array('slides'));
	
	/* Support for page templates */
	// remove_theme_support('reactor-page-templates');
	// add_theme_support(
	// 	'reactor-page-templates',
	// 	array('front-page', 'news-page', 'portfolio', 'contact')
	// );
	
	/* Remove support for background options in customizer */
	// remove_theme_support('reactor-backgrounds');
	
	/* Remove support for font options in customizer */
	// remove_theme_support('reactor-fonts');
	
	/* Remove support for custom login options in customizer */
	remove_theme_support('reactor-custom-login');
	
	/* Remove support for breadcrumbs function */
	remove_theme_support('reactor-breadcrumbs');
	
	/* Remove support for page links function */
	// remove_theme_support('reactor-page-links');
	
	/* Remove support for page meta function */
	// remove_theme_support('reactor-post-meta');
	
	/* Remove support for taxonomy subnav function */
	// remove_theme_support('reactor-taxonomy-subnav');
	
	/* Remove support for shortcodes */
	// remove_theme_support('reactor-shortcodes');
	
	/* Remove support for tumblog icons */
	remove_theme_support('reactor-tumblog-icons');
	
	/* Remove support for other langauges */
	remove_theme_support('reactor-translation');
	
	//remove image sizes
	add_image_size('thumb-300', 0, 0, true);
	add_image_size('thumb-200', 0, 0, true);
		
}


// allow shortcodes in widgets
if (!is_admin())add_filter('widget_text', 'do_shortcode', 11); 	


// write firstname/last name in to db after registering through Membership signup form
function M_AddNameProcess($error,$user_id) {	update_user_meta($user_id, 'first_name', esc_attr($_POST['first_name']));	update_user_meta($user_id, 'last_name', esc_attr($_POST['last_name']));	}	
add_action( 'membership_subscription_form_registration_process', 'M_AddNameProcess',10,2);


// remove admin bar
add_filter( 'show_admin_bar', '__return_false' );


// change login image
function custom_login_logo() {
    echo '<style type="text/css">'.
             'h1 a { background-image:url('.get_bloginfo( 'template_directory' ).'/img/login-logo.png) !important; }'.

         '</style>';
}
add_action( 'login_head', 'custom_login_logo' );

/**
 * Custom admin login header link
 */
function custom_login_url() {
    return home_url( '/' );
}
add_filter( 'login_headerurl', 'custom_login_url' );



/**
 * Custom admin login header link alt text
 */

function custom_login_title() {
    return get_option( 'blogname' );
}
add_filter( 'login_headertitle', 'custom_login_title' );


//show tertiary sidebar beneath home content but not on all pages
function earlyarts_front_widget()
{
if (is_front_page() && is_active_sidebar('sidebar-frontpage-3') )
	{
	dynamic_sidebar('sidebar-frontpage-3');
	}
}
add_action('reactor_inner_content_after', 'earlyarts_front_widget');


//adds a shortcode to hide content from non-members
add_shortcode( 'ea-member', 'member_check_shortcode' );
function member_check_shortcode( $atts, $content = null ) {
	 if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
		return do_shortcode($content);
	return '';
}

//adds a shortcode to show content only to non-members
add_shortcode( 'ea-visitor', 'visitor_check_shortcode' );
function visitor_check_shortcode( $atts, $content = null ) {
	 if ( ( !is_user_logged_in() && !is_null( $content ) ) || is_feed() )
		return do_shortcode($content);
	return '';
}

//adds logout shortcode
add_shortcode( 'logout', 'logout_shortcode' );
function logout_shortcode() {
	$x=wp_logout_url();
	return '<a href="'.$x.'">Logout</a>';
	}
	
//adds admin shortcode to admin users
add_shortcode( 'admin', 'admin_check_shortcode' );
function admin_check_shortcode( $atts, $content = null ) {
	 if ( ( current_user_can( 'edit_posts' ) && !is_null( $content ) ) || is_feed() )
		return do_shortcode($content);
	return '';
}

//change UserMetaPro system messages
// not used $msgs['registration_completed']  = __( 'You\'ve successfully registered with Earlyarts.<br><br>If you\'d like to join, please continue to <a href="/choose-a-subscription">membership options</a>', $userMeta->name );    
add_filter( 'user_meta_messages', 'earlyarts_user_meta_msg' );
function earlyarts_user_meta_msg ($msgs) {

$msgs['profile_updated']           = __( 'Information submitted, thank you.', $userMeta->name );

return $msgs;
}

// Anti-spam email links
// Use shortcode [email address"email@me.com"]My name[/email]
function ea_email_encode_function( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'address' => 'email',
	), $atts ) );

	return '<a href="mailto:' . antispambot(esc_attr($address)) . '">' . $content . '</a>';
}
add_shortcode('email', 'ea_email_encode_function');


// Upgrade Editor role to have greater capabilities for user management (inc Membership plugin)
function add_theme_caps() {
    // gets the editor role
    $role = get_role( 'editor' );
    $role->add_cap( 'create_users' ); 
	$role->add_cap( 'edit_users' );
	$role->add_cap( 'list_users' );
	$role->add_cap( 'remove_users' );
	// added capability for Membership plugin. Only needs this capability, 
	// other capabilities can be changed on a per user basis through user manager in wp-admin
	$role->add_cap( 'membershipadmin' );
	
}
add_action( 'admin_init', 'add_theme_caps');

//google analytics
function ga(){ ?>
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-17233772-1', 'earlyarts.co.uk');
  ga('send', 'pageview');

</script> 
<?php }
add_action('wp_head', 'ga','50');


/*----Adding a second Top Bar Menu----*/

function reactor_main_top_bar() {
		$defaults = array( 
			'theme_location'  => 'main-top-bar',
			'container'       => false,
			'menu_class'      => 'main-top-bar-menu',
			'echo'            => 0,
			'fallback_cb'     => false,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => new Top_Bar_Walker()
		 );
		return wp_nav_menu( $defaults );
	}
	
register_nav_menu('main-top-bar', __( 'Main Top Bar', 'reactor'));	

function reactor_do_main_top_bar() {
	if ( has_nav_menu('main-top-bar')) {
		$topbar_args = array(
			'title'     => '',
			'title_url' => home_url(),
			'fixed'     => 0,
			'contained' => 1,
			'menu_name'  => 'Main Menu',
			'left_menu'  => 'reactor_main_top_bar',	
			'right_menu' => false,			
			'sticky'     => false			
		);
		echo ('<div class="main-top-bar-wrapper">');
		reactor_top_bar( $topbar_args );
		echo ('</div>');
	}
}
add_action('reactor_header_after', 'reactor_do_main_top_bar', 3);


/*--add image to each page between menu and content area ----*/

function earlyarts_hero_image () {
?>
<div class="hero">
	<div class="row">
		<div class="<?php reactor_columns( 12 ); ?> header-hero">
			<img src="https://farm6.staticflickr.com/5543/14061349481_01a492a6e4_o.jpg" width="988" height="190">
		</div>	
	</div>
</div>
<?php
}
add_action('reactor_content_before', 'earlyarts_hero_image', 5);

/*----add width to captions----*/
add_filter('img_caption_shortcode', 'my_img_caption_shortcode_filter',100,3);

function my_img_caption_shortcode_filter($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));
	
	if ( 1 > (int) $width || empty($caption) )
		return $val;

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
	. (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
	. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

//remove reactor.js and add a copy of it with some additions, so we can control slideshow
add_action( 'wp_print_scripts', 'replace_reactor', 100 );
function replace_reactor() {
   wp_dequeue_script( 'reactor-js' );
   wp_deregister_script( 'reactor-js' );
}
add_action('wp_enqueue_scripts', 'ea_enqueue_scripts');
add_action('wp_enqueue_scripts', 'ea_register_scripts', 1);
function ea_register_scripts() {
   wp_register_script('ea-reactor-js', get_stylesheet_directory_uri() . '/library/js/ea-reactor.js', array('foundation-js'), false, true);
   }
function ea_enqueue_scripts() {
	if ( !is_admin() ) { 
		wp_enqueue_script('ea-reactor-js');
		}
}	

// remove foundicons.css and remove normalize
// I've added normalize to main stylesheet via SASS
add_action( 'wp_enqueue_scripts', 'replace_reactor_styles', 100 );
function replace_reactor_styles() {
    wp_dequeue_style('normalize');
    wp_deregister_style('normalize');
    wp_dequeue_style('foundicons');
    wp_deregister_style('foundicons');
    wp_dequeue_style('foundation');
    wp_deregister_style('foundation');
    wp_dequeue_style('reactor');
    wp_deregister_style('reactor'); 
    wp_dequeue_style('style');
    wp_deregister_style('style');
    wp_dequeue_style('eab-upcoming_calendar_widget-style');
    wp_deregister_style('eab-upcoming_calendar_widget-style');
   }	

add_action('wp_enqueue_scripts', 'ea_enqueue_styles');
add_action('wp_enqueue_scripts', 'ea_register_styles', 1);
function ea_register_styles() {
   wp_register_style('ea-style', get_stylesheet_directory_uri() . '/css/style.css', array(), false, 'all');
   }
   
function ea_enqueue_styles() {
	if ( !is_admin() ) { 
		wp_enqueue_style('ea-style');
		}
}	 



//change events+ messages
add_filter('eab-rsvps-status_messages-map','ea_change_events_conf_messages');

function ea_change_events_conf_messages()
{
$map = array(
			Eab_EventModel::BOOKING_YES => __("Excellent! We've got your place reserved. If there's a payment due you'll see a box below. Once you've made the payment, your place is confirmed", Eab_EventsHub::TEXT_DOMAIN),
			Eab_EventModel::BOOKING_MAYBE => __("Thanks for letting us know. Hopefully you'll be able to make it!", Eab_EventsHub::TEXT_DOMAIN),
			Eab_EventModel::BOOKING_NO => __("That's too bad you won't be able to make it", Eab_EventsHub::TEXT_DOMAIN),
		);
		return $map;
		}
		
/** changing default WordPress email settings */
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
 
function new_mail_from($old) {
 return 'info@earlyarts.co.uk';
}
function new_mail_from_name($old) {
 return 'Earlyarts';
}

/** making a page to reset authentication cookies, to help fix problem with users appearing to be logged in, but not being able to see protected pages **/
add_action ('reactor_page_after','ea_clear_auth_cookie');

function ea_clear_auth_cookie()
{
if (is_page('cookie-clear'))
	{
	echo ('<h3>By visiting this page, you\'ve just logged out and reset your cookies.</h3>');
	echo ('<p>Now try to <a href="/login"><strong>log in again</strong></a></p>');
	wp_clear_auth_cookie(); 
	}
}

//The following require modifies the product listing pages
// mp_productlist and mp_category
require_once ('library/inc/ea-extras/ea-marketpress.php');

// removes ref to marketpress styles
add_theme_support( 'mp_style' );

// User Meta Pro filters to encode characters when doing form based redirects (otherwise '?' get encoded )
add_filter( 'user_meta_wp_hook', 'enableRegistrationRedirect', 10, 2 );
function enableRegistrationRedirect( $enable, $hookName ) {
    if ( 'registration_redirect' == $hookName )
        $enable = true;

    return $enable;
}

add_filter( 'registration_redirect', 'urlHtmlDecode' );
function urlHtmlDecode( $redirect_to ) {
    if ( ! empty( $redirect_to ) )
        $redirect_to = html_entity_decode( $redirect_to );

    return $redirect_to;
}