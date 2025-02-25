<?php

namespace MSDEvents\Managers;

use MSDEvents\PostTypes\EventPostType;
use MSDEvents\PostTypes\EventMetaBox;

class PostTypesManager {
	public static function init() {
		add_action('init', [EventPostType::class, 'register']);
	}
}
