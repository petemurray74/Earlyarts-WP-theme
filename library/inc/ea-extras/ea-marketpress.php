<?php
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

		$content = '<ul class="small-block-grid-2 large-block-grid-3">';
		
		if ($last = $custom_query->post_count) {

			$content .= $layout_type == 'grid' ?
					ea_mp_products_html_grid($custom_query->posts) :
					_mp_products_html_list($custom_query->posts);
		} else {
			$content .= '<div id="mp_no_products">' . apply_filters('mp_product_list_none', __('No Products', 'mp')) . '</div>';
		}

		$content .= '</ul>';
		
		if ($echo)
			echo $content;
		else
			return $content;
}

function ea_mp_products_html_grid($post_array = array()) {
    global $mp;
    $html = '';

    foreach ($post_array as $post) {

        $img = mp_product_image(false, 'list', $post->ID);
        $excerpt = $mp->get_setting('show_excerpt') ?
                '<p class="mp_excerpt">' . $mp->product_excerpt($post->post_excerpt, $post->post_content, $post->ID, '') . '</p>' :
                '';
        $mp_product_list_content = apply_filters('mp_product_list_content', $excerpt, $post->ID);

        $html .= '<li>
				<div class="ea_mp_product_detail">
				' . $img . '
				<h3 class="ea_mp_product_name"> 
				  <a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a>
				</h3>
				' . $mp_product_list_content . '
				</div>

				<div class="ea_mp_price_buy">
				' . mp_product_price(false, $post->ID,'From: ') . '
				' . apply_filters('mp_product_list_meta', '', $post->ID) . '
				</div>					
              </li>';
    }

    return $html;
}
// BUY BUTTON removed
// <div class="ea_mp_buy"><span><a class="small button" href="'.get_permalink($post->ID) . '">Details and formats</a></span></div>


//
// Function to apply discounts to members
// ref:http://premium.wpmudev.org/forums/topic/how-do-i-offer-separating-pricing-for-premium-members-using-marketpress

function mp_membership_price_discount( $price ){
	// check for existence of Membership plugin
	if ( class_exists( 'M_Membership' ) ) {
		// check if user is logged in
		if ( is_user_logged_in() ){	
		// take 10% discount for users on access level with id=5
			if ( current_user_on_level(5) ) {
				return $price * 0.9;
			}
		}
	}
	return $price;
}
add_filter( 'mp_product_price', 'mp_membership_price_discount' );

// shortcode to add an 'add to cart' button to a page

//  [printversion productid=5232] 
function PrintVersionBox($params) {
	extract(shortcode_atts(array(
		'productid' => 6620,
        'textlabel' => 'Printed version'
	), $params));
	
	return
	'
	<div class="panel" style="border:none;">
		<div class="row" style="background:none;">
			<div class="column large-6 small-12">
			<span class="preprice">'.$textlabel.':<br></span>'.do_shortcode("[mp_product_price product_id=\"$productid\" label=\"\"]").'
			</div>
			<div class="column large-6 small-12">
			<form class="mp_buy_form" method="post" action="/store/shopping-cart/" style="display: block;"><input type="hidden" name="product_id" value="'.$productid.'"><input type="hidden" name="variation" value="0"><input type="hidden" name="action" value="mp-update-cart"><input class="mp_button_addcart" type="submit" name="addcart" value="Add To Cart »"></form>                                
			</div>
		</div>
	</div>
';
	
}
add_shortcode('printversion','PrintVersionBox');


// shortcode to add pack contents table
//  [packcontents] 
function PackContentsTable() {
	return
'
<table width="100%">
<thead>
<tr>
<th>THIS PACK CONTAINS</th>
</tr>
</thead>
<tbody>
<tr>
<td>Artists\' Intention and Learning Objectives</td>
</tr>
<tr>
<td>Step-by-Step Creative Activity Plans</td>
</tr>
<tr>
<td>Environment and Resource Lists</td>
</tr>
<tr>
<td>Top Tips to support Additional Learning Needs</td>
</tr>
<tr>
<td>Guidance for Reflection and Planning</td>
</tr>
<tr>
<td>Activities Mapped against EYFS Areas of Learning</td>
</tr>
<tr>
<td>Case Study of Activities in Practice</td>
</tr>
<tr>
<td><strong>Each pack has between 16-24 pages, in full colour, and has an easy-to-clean matt laminate cover</strong></td>
</tr>
</tbody>
</table>
';
	
}
add_shortcode('packcontents','PackContentsTable');

// shortcode to add buy now button
//  [buyboxset] 
function BuyBoxSetNow() {
	return
'
<a class="button radius secondary small" title="Earlyarts Box Set" href="/store/products/nurturing-young-childrens-learning-box-set/" >Save a whopping 40% and buy this pack in a box-set!</a>
';
	
}
add_shortcode('buyboxset','BuyBoxSetNow');

