<?php

function msd_events_render_event_submission_form($attributes, $content) {
	ob_start();
	?>
	<form id="event-submission-form">
		<p>
			<label for="event_name">Event Name:</label>
			<input type="text" id="event_name" name="event_name" required>
		</p>
		<p>
			<label for="event_description">Event Description:</label>
			<textarea id="event_description" name="event_description" required></textarea>
		</p>
		<p>
			<label for="event_date">Event Date:</label>
			<input type="date" id="event_date" name="event_date" required>
		</p>
		<p>
			<label for="event_location">Event Location:</label>
			<input type="text" id="event_location" name="event_location" required>
		</p>
		<p>
			<button type="submit">Submit Event</button>
		</p>
	</form>
	<?php
	return ob_get_clean();
}

register_block_type(__DIR__, [
	'render_callback' => 'msd_events_render_event_submission_form'
]);
