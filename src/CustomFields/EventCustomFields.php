<?php

namespace MSDEvents\CustomFields;

class EventCustomFields {
	public static function init() {
		add_action('add_meta_boxes', [self::class, 'add_meta_box']);
		add_action('save_post', [self::class, 'save_meta_data']);
	}

	public static function add_meta_box() {
		add_meta_box(
			'event_details',
			__('Event Details', 'msd-events'),
			[self::class, 'render_meta_box'],
			'event',
			'normal',
			'high'
		);
	}

	public static function render_meta_box($post) {
		$event_date  = get_post_meta($post->ID, '_event_date', true);
		$event_location = get_post_meta($post->ID, '_event_location', true);
		$event_latitude = get_post_meta($post->ID, '_event_latitude', true);
		$event_longitude = get_post_meta($post->ID, '_event_longitude', true);

		wp_nonce_field('event_meta_nonce', 'event_meta_nonce_field');

		?>
		<p>
			<label for="event_date"><?php _e('Event Date:', 'msd-events'); ?></label>
			<input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>">
		</p>
		<p>
			<label for="event_location"><?php _e('Event Location:', 'msd-events'); ?></label>
			<input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>" style="width:100%;">
		</p>
		<p>
			<label for="event_latitude"><?php _e('Latitude:', 'msd-events'); ?></label>
			<input type="text" id="event_latitude" name="event_latitude" value="<?php echo esc_attr($event_latitude); ?>">
		</p>
		<p>
			<label for="event_longitude"><?php _e('Longitude:', 'msd-events'); ?></label>
			<input type="text" id="event_longitude" name="event_longitude" value="<?php echo esc_attr($event_longitude); ?>">
		</p>
		<?php
	}

	public static function save_meta_data($post_id) {
		if (!isset($_POST['event_meta_nonce_field']) || !wp_verify_nonce($_POST['event_meta_nonce_field'], 'event_meta_nonce')) {
			return;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (isset($_POST['event_date'])) {
			update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
		}

		if (isset($_POST['event_location'])) {
			update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
		}

		if (isset($_POST['event_latitude'])) {
			update_post_meta($post_id, '_event_latitude', sanitize_text_field($_POST['event_latitude']));
		}

		if (isset($_POST['event_longitude'])) {
			update_post_meta($post_id, '_event_longitude', sanitize_text_field($_POST['event_longitude']));
		}
	}
}
