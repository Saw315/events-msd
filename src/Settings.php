<?php

namespace MSDEvents;

class Settings {
	public static function init() {
		add_action( 'admin_menu', [ self::class, 'add_settings_page' ] );
		add_action( 'admin_init', [ self::class, 'register_settings' ] );
	}

	/**
	 * Add a menu item for the settings page.
	 */
	public static function add_settings_page() {
		add_menu_page(
			__( 'MSD Events Settings', 'msd-events' ),
			__( 'MSD Events', 'msd-events' ),
			'manage_options',
			'msd-events-settings',
			[ self::class, 'render_settings_page' ],
			'dashicons-location',
			60
		);
	}

	/**
	 * Register settings.
	 */
	public static function register_settings() {
		register_setting( 'msd_events_settings', 'msd_google_maps_api_key' );

		add_settings_section(
			'msd_events_main_settings',
			__( 'Google Maps Settings', 'msd-events' ),
			null,
			'msd-events-settings'
		);

		add_settings_field(
			'msd_google_maps_api_key',
			__( 'Google Maps API Key', 'msd-events' ),
			[ self::class, 'google_maps_api_key_field' ],
			'msd-events-settings',
			'msd_events_main_settings'
		);
	}

	/**
	 * Render the API key input field.
	 */
	public static function google_maps_api_key_field() {
		$api_key = get_option( 'msd_google_maps_api_key', '' );
		?>
        <input type="text" name="msd_google_maps_api_key" value="<?php echo esc_attr( $api_key ); ?>"
               class="regular-text">
        <p class="description"><?php _e( 'Enter your Google Maps API key.', 'msd-events' ); ?></p>
		<?php
	}

	/**
	 * Render the settings page.
	 */
	public static function render_settings_page() {
		?>
        <div class="wrap">
            <h1><?php _e( 'MSD Events Settings', 'msd-events' ); ?></h1>
            <form method="post" action="options.php">
				<?php
				settings_fields( 'msd_events_settings' );
				do_settings_sections( 'msd-events-settings' );
				submit_button();
				?>
            </form>
        </div>
		<?php
	}
}
