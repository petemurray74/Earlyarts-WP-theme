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
	add_theme_support(
		'reactor-post-types',
	 	array('slides')
	 );
	
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
add_filter( 'user_meta_messages', 'earlyarts_user_meta_msg' );
function earlyarts_user_meta_msg ($msgs) {

$msgs['profile_updated']           = __( 'Information submitted, thank you.', $userMeta->name );

$msgs['registration_completed']  = __( 'You\'ve successfully registered with Earlyarts.<br><br>If you\'d like to buy a subscription, please continue to <a href="/choose-a-subscription">choose a subscription</a>', $userMeta->name );    

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
			<img src="<?php echo(get_stylesheet_directory_uri()); ?>/images/hero_internal.jpg">
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
// I've added normalize to foundation.min.css
add_action( 'wp_enqueue_scripts', 'replace_reactor_styles', 100 );
function replace_reactor_styles() {
   wp_dequeue_style('normalize');
   wp_deregister_style('normalize');
   wp_dequeue_style('foundicons');
   wp_deregister_style('foundicons');
   wp_dequeue_style('style');
   wp_deregister_style('style');
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
			Eab_EventModel::BOOKING_YES => __("Excellent! We've got your place reserved. Please make your payment below to confirm your place, unless you're a subscribed member", Eab_EventsHub::TEXT_DOMAIN),
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

//The following two functions modify the product listing pages
// mp_productlist and mp_category

function ea_mp_list_products($echo = true, $paginate = '', $page = '', $per_page = '', $order_by = '', $order = '', $category = '', $tag = '', $list_view = NULL) {
		global $wp_query, $mp;
		//setup taxonomy if applicable
		if ($category) {
			$taxonomy_query = '&product_category=' . sanitize_title($category);
		} else if ($tag) {
			$taxonomy_query = '&product_tag=' . sanitize_title($tag);
		} else if (isset($wp_query->query_vars['taxonomy']) && ($wp_query->query_vars['taxonomy'] == 'product_category' || $wp_query->query_vars['taxonomy'] == 'product_tag')) {
			//TODO might need to fix for tags that are a number
			$taxonomy_query = '&' . $wp_query->query_vars['taxonomy'] . '=' . $wp_query->query_vars['term'];
		} else {
			$taxonomy_query = '';
		}

		//setup pagination
		$paged = false;
		if ($paginate) {
			$paged = true;
		} else if ($paginate === '') {
			if ($mp->get_setting('paginate'))
				$paged = true;
			else
				$paginate_query = '&nopaging=true';
		} else {
			$paginate_query = '&nopaging=true';
		}

		//get page details
		if ($paged) {
			//figure out perpage
			if (intval($per_page)) {
				$paginate_query = '&posts_per_page=' . intval($per_page);
			} else {
				$paginate_query = '&posts_per_page=' . $mp->get_setting('per_page');
			}

			//figure out page
			if (isset($wp_query->query_vars['paged']) && $wp_query->query_vars['paged'])
				$paginate_query .= '&paged=' . intval($wp_query->query_vars['paged']);

			if (intval($page))
				$paginate_query .= '&paged=' . intval($page);
			else if ($wp_query->query_vars['paged'])
				$paginate_query .= '&paged=' . intval($wp_query->query_vars['paged']);
		}

		//get order by
		if (!$order_by) {
			if ($mp->get_setting('order_by') == 'price')
				$order_by_query = '&meta_key=mp_price_sort&orderby=meta_value_num';
			else if ($mp->get_setting('order_by') == 'sales')
				$order_by_query = '&meta_key=mp_sales_count&orderby=meta_value_num';
			else
				$order_by_query = '&orderby=' . $mp->get_setting('order_by');
		} else {
			if ('price' == $order_by)
				$order_by_query = '&meta_key=mp_price_sort&orderby=meta_value_num';
			else if ('sales' == $order_by)
				$order_by_query = '&meta_key=mp_sales_count&orderby=meta_value_num';
			else
				$order_by_query = '&orderby=' . $order_by;
		}

		//get order direction
		if (!$order) {
			$order_query = '&order=' . $mp->get_setting('order');
		} else {
			$order_query = '&order=' . $order;
		}

		//The Query
		$custom_query = new WP_Query('post_type=product&post_status=publish' . $taxonomy_query . $paginate_query . $order_by_query . $order_query);

		//allows pagination links to work get_posts_nav_link()
		if ($wp_query->max_num_pages == 0 || $taxonomy_query)
			$wp_query->max_num_pages = $custom_query->max_num_pages;

		// get layout type for products
		if (is_null($list_view)) {
			$layout_type = $mp->get_setting('list_view');
		} else {
			$layout_type = $list_view ? 'list' : 'grid';
		}

		$content = '<div id="mp_product_list" class="mp_' . $layout_type . '">';

		if ($last = $custom_query->post_count) {

			$content .= $layout_type == 'grid' ?
					ea_mp_products_html_grid($custom_query->posts) :
					_mp_products_html_list($custom_query->posts);
		} else {
			$content .= '<div id="mp_no_products">' . apply_filters('mp_product_list_none', __('No Products', 'mp')) . '</div>';
		}

		$content .= '</div>';

		if ($echo)
			echo $content;
		else
			return $content;
}

function ea_mp_products_html_grid($post_array = array()) {
    global $mp;
    $html = '';

    //get image width
    if ($mp->get_setting('list_img_size') == 'custom') {
        $width = $mp->get_setting('list_img_width');
    } else {
        $size = $mp->get_setting('list_img_size');
        $width = get_option($size . "_size_w");
    }

    $inline_style = !( $mp->get_setting('store_theme') == 'none' || current_theme_supports('mp_style') );

    foreach ($post_array as $post) {

        $img = mp_product_image(false, 'list', $post->ID);
        $excerpt = $mp->get_setting('show_excerpt') ?
                '<p class="mp_excerpt">' . $mp->product_excerpt($post->post_excerpt, $post->post_content, $post->ID, '') . '</p>' :
                '';
        $mp_product_list_content = apply_filters('mp_product_list_content', $excerpt, $post->ID);

        $class = array();
        $class[] = strlen($img) > 0 ? 'mp_thumbnail' : '';
        $class[] = strlen($excerpt) > 0 ? 'mp_excerpt' : '';
        $class[] = mp_has_variations($post->ID) ? 'mp_price_variations' : '';

        $html .= '<div class="mp_one_tile ' . implode($class, ' ') . '">
                <div class="mp_one_product"' . ($inline_style ? ' style="width: ' . $width . 'px;"' : '') . '>

                  <div class="mp_product_detail"' . ($inline_style ? ' style="width: ' . $width . 'px;"' : '') . '>
                    ' . $img . '

                    <h3 class="mp_product_name"> 
                      <a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a>
                    </h3>

                    ' . $mp_product_list_content . '
                  </div>

                </div>
              </div>';
    }

    $html .= (count($post_array) > 0 ? '<div class="clear"></div>' : '');

    return $html;
}