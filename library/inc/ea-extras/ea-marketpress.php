<?php

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
//  [packcontents] .
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
	if ( get_query_var( 'mp_order_id', 0 ) == '0' ) {
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

//MAKE MARKETPRESS (and other?) email confirmations HTML format
add_filter( 'wp_mail_content_type', 'set_content_type', 999, 1 );
function set_content_type( $content_type ) {
	return 'text/html';
}
