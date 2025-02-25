<?php

namespace MSDEvents\PostTypes;

class EventPostType {
	public static function register() {
		$labels = [
			'name'               => __('Events', 'msd-events'),
			'singular_name'      => __('Event', 'msd-events'),
			'menu_name'          => __('Events', 'msd-events'),
			'name_admin_bar'     => __('Event', 'msd-events'),
			'add_new'            => __('Add New', 'msd-events'),
			'add_new_item'       => __('Add New Event', 'msd-events'),
			'new_item'           => __('New Event', 'msd-events'),
			'edit_item'          => __('Edit Event', 'msd-events'),
			'view_item'          => __('View Event', 'msd-events'),
			'all_items'          => __('All Events', 'msd-events'),
			'search_items'       => __('Search Events', 'msd-events'),
			'not_found'          => __('No events found.', 'msd-events'),
			'not_found_in_trash' => __('No events found in Trash.', 'msd-events'),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'has_archive'        => true,
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-calendar',
			'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
			'rewrite'            => ['slug' => 'events'],
		];

		register_post_type('event', $args);
	}
}