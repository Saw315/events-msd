<?php

namespace MSDEvents\Managers;

use MSDEvents\Taxonomies\EventTypeTaxonomy;

class TaxonomiesManager {
	public static function init() {
		add_action('init', [EventTypeTaxonomy::class, 'register']);
	}
}