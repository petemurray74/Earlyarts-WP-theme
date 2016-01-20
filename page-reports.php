<?php
/*
Template Name: Reports
*/

/* use the page in WordPress called reports to display this page */
?>
<h3>Purchasers</h3>
<p>Purchases made through Marketpress (excludes events)</p>
<?php

$args = array(
'post_type' => 'mp_order',
'post_status' => 'order_shipped',
'posts_per_page'=> -1
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	$emailArr=Array();
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$order_id=get_the_ID();
		$shipping_info = get_post_meta( $order_id, 'mp_shipping_info' );
		$thisEmail="UNKNOWN";
		if (is_array($shipping_info[0]))
		{
		$thisEmail=$shipping_info[0]['email'];
		}
		$purchDetailsArr[]=array($thisEmail,get_the_date());
}
//print_r ($purchDetailsArr);
		?>
<table border="1" cellpadding="2">		
		<?php

foreach ($purchDetailsArr as $purchaserArr)
{
	echo ('<tr><td>'.$purchaserArr[0].'</td><td>'.$purchaserArr[1].'</td></tr>');
}
?></table>
<?php
wp_reset_postdata();
}

