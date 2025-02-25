<?php

namespace MSDEvents\Managers;

use MSDEvents\Api\EventSubmissionApi;

class APIManager {
	public static function init() {
		add_action('init', [EventSubmissionApi::class, 'init']);
	}
}