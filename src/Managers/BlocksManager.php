<?php

namespace MSDEvents\Managers;

class BlocksManager {
	public static function init() {
		add_action('init', function () {
			register_block_type(__DIR__ . '/../Blocks/EventSubmission');
		});
	}
}