<?php

namespace MSDEvents\Api;

class EventSubmissionApi {
	public static function init() {
		add_action( 'rest_api_init', [ self::class, 'register_routes' ] );
	}

	public static function register_routes() {
		register_rest_route( 'msd-events/v1', '/submit-event', [
			'methods'             => 'POST',
			'callback'            => [ self::class, 'handle_event_submission' ],
			'permission_callback' => [ self::class, 'validate_nonce' ],
		] );
	}

	public static function validate_nonce( $request ) {
		$nonce = $request->get_header( 'X-WP-Nonce' );
		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			return new \WP_Error( 'rest_forbidden', __( 'Invalid nonce' ), [ 'status' => 403 ] );
		}

		return true;
	}

	public static function handle_event_submission( $request ) {

		// Get the JSON parameters
		$params            = $request->get_json_params();
		$event_name        = sanitize_text_field( $params['event_name'] ?? '' );
		$event_description = sanitize_textarea_field( $params['event_description'] ?? '' );
		$event_date        = sanitize_text_field( $params['event_date'] ?? '' );
		$event_location    = sanitize_text_field( $params['event_location'] ?? '' );
		$event_latitude    = sanitize_text_field( $params['event_latitude'] ?? '' );
		$event_longitude   = sanitize_text_field( $params['event_longitude'] ?? '' );

		// Validate required fields
		if ( empty( $event_name ) || empty( $event_date ) || empty( $event_location ) ) {
			return new \WP_Error( 'missing_fields', __( 'Required fields are missing', 'msd-events' ), [ 'status' => 400 ] );
		}

		// Create the event as a "pending" post to prevent spam
		$event_id = wp_insert_post( [
			'post_title'   => $event_name,
			'post_content' => $event_description,
			'post_type'    => 'event',
			'post_status'  => 'pending', // Ensure moderation
		] );

		if ( is_wp_error( $event_id ) ) {
			error_log( "[Event Submission] " . "Failed to create event: " . $event_id->get_error_message() );

			return new \WP_Error( 'event_creation_failed', __( 'Could not create event', 'msd-events' ), [ 'status' => 500 ] );
		}

		// Save metadata
		update_post_meta( $event_id, '_event_date', $event_date );
		update_post_meta( $event_id, '_event_location', $event_location );
		update_post_meta( $event_id, '_event_latitude', $event_latitude );
		update_post_meta( $event_id, '_event_longitude', $event_longitude );

		return rest_ensure_response( [
			'success'  => true,
			'message'  => __( 'Event successfully submitted! It is awaiting moderation.', 'msd-events' ),
			'event_id' => $event_id,
		] );
	}
}
