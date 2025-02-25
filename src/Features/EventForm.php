<?php

namespace MSDEvents\Features;

class EventForm {
	public static function init() {
		add_shortcode( 'msd_event_form', [ self::class, 'render_shortcode' ] );
	}

	public static function render_shortcode() {
		self::enqueue_scripts();

		return self::render_form();
	}

	private static function enqueue_scripts() {
		$google_api_key = get_option( 'msd_google_maps_api_key', '' );

		wp_enqueue_script(
			'google-maps-api',
			'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_api_key ) . '&libraries=places',
			[],
			null,
			true
		);

		wp_enqueue_script(
			'msd-event-form',
			get_template_directory_uri() . '/assets/js/event-form.js',
			[],
			filemtime( get_template_directory() . '/assets/js/event-form.js' ),
			true
		);

		wp_localize_script( 'msd-event-form', 'msdEventFormData', [
			'ajax_url' => esc_url( rest_url( 'msd-events/v1/submit-event' ) ),
		] );
	}

	public static function render_form() {
		$unique_id = uniqid( 'event_' );

		ob_start();
		?>
        <form id="<?php echo esc_attr( $unique_id ); ?>" class="msd-form">
            <div class="msd-form__row">
                <label for="event_name"><?php _e( 'Event Name:', 'msd-events' ); ?></label>
                <input type="text" id="event_name" name="event_name" required>
                <span class="error-message"></span>
            </div>
            <div class="msd-form__row">
                <label for="event_description"><?php _e( 'Event Description:', 'msd-events' ); ?></label>
                <textarea id="event_description" name="event_description" required></textarea>
                <span class="error-message"></span>
            </div>
            <div class="msd-form__row">
                <label for="event_date"><?php _e( 'Event Date:', 'msd-events' ); ?></label>
                <input type="date" id="event_date" name="event_date" required>
                <span class="error-message"></span>
            </div>
            <div class="msd-form__row">
                <label for="event_location"><?php _e( 'Event Location:', 'msd-events' ); ?></label>
                <input type="text" id="event_location" name="event_location" required>
                <input type="hidden" id="event_latitude" name="event_latitude">
                <input type="hidden" id="event_longitude" name="event_longitude">
                <span class="error-message"></span>
            </div>
            <div class="msd-form__row">
                <button type="submit" class="button"><?php _e( 'Submit Event', 'msd-events' ); ?></button>
            </div>
            <div class="form-status"></div>
        </form>
		<?php
		return ob_get_clean();
	}
}
