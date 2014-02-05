<?php
/*
Template controlling the display of events archive listing pages, 
using, in this case [eab_archive template="shortcode-archive-default"]

Template copied form 
wp-content/plugins/events-and-bookings/default-templates

*/
?>

<section class="eab-events-archive <?php esc_attr_e($args['class']); ?>">
<?php foreach ($events as $event) { ?>
	<article class="eab-event <?php echo eab_call_template('get_status_class', $event); ?>" id="eab-event-<?php echo $event->get_id(); ?>">
		<h2><?php echo $event->get_title(); ?></h2>
		<div class="eab-event-body">
			<?php echo eab_call_template('get_archive_content', $event); ?>
		</div>
	</article>
<?php } ?>
</section>