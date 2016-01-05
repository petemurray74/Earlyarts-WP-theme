<?php

// overwriting the same function from template-functions.php
// hacked to work for grid display only.
	function z_mp_products_html( $view, $custom_query, $related_products = false ) {

		$html = '<ul class="small-block-grid-2 large-block-grid-3">';


//get image width
		if ( mp_get_setting( 'list_img_size' ) == 'custom' ) {
			$img_width = mp_get_setting( 'list_img_width' ) . 'px';
		} else {
			$size      = mp_get_setting( 'list_img_size' );
			$img_width = get_option( $size . '_size_w' ) . 'px';
		}

		while ( $custom_query->have_posts() ) : $custom_query->the_post();
			$product = new MP_Product();

			$align = null;
			if ( 'list' == mp_get_setting( 'list_view' ) ) {
				$align = mp_get_setting( 'image_alignment_list' );
			}

			$img = $product->image( false, 'list', null, $align, true );

			$excerpt = mp_get_setting( 'show_excerpts' ) ? '<div class="mp_product_excerpt"><p>' . $product->excerpt() . '</div></p><!-- end mp_product_excerpt -->' : '';
			$mp_product_list_content = apply_filters( 'mp_product_list_content', $excerpt, $product->ID );

			$pinit   = $product->pinit_button( 'all_view' );
			$fb      = $product->facebook_like_button( 'all_view' );
			$twitter = $product->twitter_button( 'all_view' );

			$class   = array();
			$class[] = ( strlen( $img ) > 0 ) ? 'mp_thumbnail' : '';
			$class[] = ( strlen( $excerpt ) > 0 ) ? 'mp_excerpt' : '';
			$class[] = ( $product->has_variations() ) ? 'mp_price_variations' : '';
			$class[] = ( $product->on_sale() ) ? 'mp_on_sale' : '';

			$class = array_filter( $class, create_function( '$s', 'return ( ! empty( $s ) );' ) );

			$image_alignment = mp_get_setting( 'image_alignment_list' );

			//$align_class = ( $view == 'list' ) ? ' mp_product-image-' . ( ! empty( $image_alignment ) ? $image_alignment : 'alignleft' ) : '';

			$html .= '
				<li><div class="ea_mp_product_detail">
					<div itemscope itemtype="http://schema.org/Product" class="mp_product' . ( ( strlen( $img ) > 0 ) ? ' mp_product-has-image' : '' ) . ' ' . implode( $class, ' ' ) . '">
					
						<div class="mp_product_images">
							' . $img . '
						</div><!-- end mp_product_images -->
						
						<div class="mp_product_details">
 
							<div class="mp_product_meta">
								<h3 class="ea_mp_product_name entry-title" itemprop="name">
	 								<a href="' . $product->url( false ) . '">' . $product->title( false ) . '</a>
	 							</h3>
								' . $product->display_price( false ) . '
 								' . $mp_product_list_content . '
 								
 								<div class="mp_social_shares">
									' . $pinit . '
									' . $fb . '
									' . $twitter . '
								</div><!-- end mp_social_shares -->
 								
							</div><!-- end mp_product_meta -->

							<div class="mp_product_callout">
								' . $product->buy_button( false, 'list', array(), true ) . '
								' . apply_filters( 'mp_product_list_meta', '', $product->ID ) . '
							</div><!-- end mp_product_callout -->
							
 						</div><!-- end mp_product_details -->
						
					</div><!-- end mp_product -->
				</div></li><!-- end mp_product_item -->';

		endwhile;

			$html .= '</ul>';

		wp_reset_postdata();

		/**
		 * Filter the product list html content
		 *
		 * @since 3.0
		 *
		 * @param string $html .
		 * @param WP_Query $custom_query .
		 */

		return apply_filters( "_mp_products_html_{$view}", $html, $custom_query );
	}

/*function ea_mp_products_html_grid($post_array = array()) {
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
*/


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
			<div class="column large-6 small-12">'.
			do_shortcode("[mp_buy_button product_id=\"$productid\" context=\"single\"]")
			.'                               
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
<a class="button radius primary medium" title="Earlyarts Box Set" href="/store/products/nurturing-young-childrens-learning-box-set/" >Save a whopping 40% and buy this pack in a box-set!</a>
';
	
}
add_shortcode('buyboxset','BuyBoxSetNow');

// COLLECT ECOMMERCE DATA FROM ORDER COMPLETE PAGE
// adding ecommerce data to payment confirmed page, in a format to work with Google Tag Manager
// from https://premium.wpmudev.org/forums/topic/marketpress-and-google-tag-manager#post-887957

add_action( 'wp_head', 'display_google_tag_manager_code' );
function display_google_tag_manager_code() {
	if ( get_query_var( 'mp_order_id', 0 ) == 0 ) {
		return;
	}
	//check does the page is confirmation step (last step)
	$order_id = get_query_var( 'mp_order_id', 0 );
	$order = new MP_Order( $order_id );
	if ( ! $order->exists() ) {
		return;
	}
	$cart = $order->get_cart();
	//javascript process code here
	if ( is_array( $cart->get_items() ) && count( $cart->get_items() ) ) {
		?>
	<!-- Google Tag Manager  Ecommerce -->
	<script>
	dataLayer=[{
		"transactionId": "<?php echo(esc_attr( $order->post_title )); ?>",	// Transaction ID Required.
		"transactionAffiliation": "<?php echo(esc_attr( get_bloginfo( 'blogname' ) )); ?>",	// Affiliation or store name.
		"transactionTotal": <?php echo($cart->total()); ?>,	// Grand Total.
		"transactionShipping": "<?php echo($cart->shipping_total()); ?>",	// Shipping.
		"transactionTax": <?php echo($cart->tax_total()); ?>,	// Tax.
		"transactionProducts": [
		<?php
			//loop the items
			$counter=0;
		foreach ( $cart->get_items_as_objects() as $product ) {
			$sku = $product->get_meta( 'sku', $product->ID );
			?> {
								 "id": "<?php echo(esc_attr( $order->post_title )) ; ?>", // Transaction ID. Required.
								 "name": "<?php echo(esc_attr( $product->post_title )) ; ?>",	// Product name. Required.
								 "sku": "<?php echo($sku) ?>",	// SKU/code.
								 "price": <?php echo($product->get_price( 'lowest' )) ; ?>,	// Unit price.
								 "quantity": <?php echo($product->qty) ; ?>	// Quantity.
							}
		<?php
		$counter ++;
		if ($counter != count( $cart->get_items() )) {
			// add a comma
			?>
			,
			<?php
			}
		}
		?> ]}];
	</script>
	<!-- End Google Tag Manager Ecommerce -->
	<?php
	}
}

