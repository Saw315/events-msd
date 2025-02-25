<?php

namespace MSDEvents;

use MSDEvents\Managers\PostTypesManager;
use MSDEvents\Managers\TaxonomiesManager;
use MSDEvents\Managers\CustomFieldsManager;
use MSDEvents\Managers\FeaturesManager;
use MSDEvents\Managers\APIManager;

class Frontend {
	public static function init() {
		PostTypesManager::init();
		TaxonomiesManager::init();
		CustomFieldsManager::init();
		FeaturesManager::init();
		APIManager::init();

		// Enqueue styles
		add_action( 'wp_enqueue_scripts', [ self::class, 'enqueue_styles' ] );
	}

	/**
	 * Enqueues the main CSS file (msd.css).
	 */
	public static function enqueue_styles() {

		$google_api_key = get_option( 'msd_google_maps_api_key', '' );

		wp_enqueue_style(
			'msd-main-style',
			get_template_directory_uri() . '/assets/css/msd.css',
			[],
			filemtime( get_template_directory() . '/assets/css/msd.css' )
		);
		wp_enqueue_style(
			'normalize',
			get_template_directory_uri() . '/assets/css/normalize.css',
			[],
			filemtime( get_template_directory() . '/assets/css/normalize.css' )
		);
		wp_enqueue_style(
			'event-form',
			get_template_directory_uri() . '/assets/css/event-form.css',
			[],
			filemtime( get_template_directory() . '/assets/css/event-form.css' )
		);

		if ( is_page_template( 'template-events.php' ) ) {

			wp_enqueue_script(
				'google-maps-api',
				'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_api_key ) . '&callback=initMap&libraries=marker',
				[],
				null,
				array(
					'in_footer' => true,
					'strategy'  => 'defer',
				)
			);

			wp_enqueue_style(
				'event-list',
				get_template_directory_uri() . '/assets/css/event-list.css',
				[],
				filemtime( get_template_directory() . '/assets/css/event-list.css' )
			);
		}
	}
}
