<?php

namespace MSDEvents\Managers;

use MSDEvents\Features\EventForm;

class FeaturesManager {
	public static function init() {
		add_action('init', [EventForm::class, 'init']);
	}
}
