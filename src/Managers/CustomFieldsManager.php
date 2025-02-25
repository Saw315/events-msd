<?php

namespace MSDEvents\Managers;

use MSDEvents\CustomFields\EventCustomFields;

class CustomFieldsManager {
	public static function init() {
		add_action('init', [EventCustomFields::class, 'init']);
	}
}