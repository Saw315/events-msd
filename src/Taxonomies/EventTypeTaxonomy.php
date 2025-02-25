<?php

namespace MSDEvents\Taxonomies;

class EventTypeTaxonomy {
	public static function register() {
		$labels = [
			'name'              => __('Event Types', 'msd-events'),
			'singular_name'     => __('Event Type', 'msd-events'),
			'search_items'      => __('Search Event Types', 'msd-events'),
			'all_items'         => __('All Event Types', 'msd-events'),
			'edit_item'         => __('Edit Event Type', 'msd-events'),
			'update_item'       => __('Update Event Type', 'msd-events'),
			'add_new_item'      => __('Add New Event Type', 'msd-events'),
			'new_item_name'     => __('New Event Type Name', 'msd-events'),
			'menu_name'         => __('Event Types', 'msd-events'),
		];

		$args = [
			'labels'            => $labels,
			'public'            => true,
			'hierarchical'      => true, // True makes it like categories, false makes it like tags
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => ['slug' => 'event-type'],
		];

		register_taxonomy('event_type', ['event'], $args);
	}
}