<?php
/**
 * Template Name: Upcoming Events
 */

get_header();

$cache_key     = 'msd_upcoming_events';
$cached_events = get_transient( $cache_key );

if ( false === $cached_events ) {
	$today  = date( 'Ymd' );
	$events = new WP_Query( [
		'post_type'      => 'event',
		'posts_per_page' => 10,
		'meta_key'       => '_event_date',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_query'     => [
			[
				'key'     => '_event_date',
				'compare' => '>=',
				'value'   => $today,
				'type'    => 'DATE',
			],
		],
	] );

	// Store query results in cache for 1 hour
	set_transient( $cache_key, $events, HOUR_IN_SECONDS );
} else {
	$events = $cached_events;
}

?>
    <main class="msd-events">
        <h1><?php _e( 'Upcoming Events', 'msd-events' ); ?></h1>
        <div class="msd-events__inner">
            <div id="map"></div>
            <div class="msd-events__content">
				<?php
				if ( $events->have_posts() ) :
					while ( $events->have_posts() ) : $events->the_post();
						$event_id       = get_the_ID();
						$event_date     = get_post_meta( $event_id, '_event_date', true );
						$event_location = get_post_meta( $event_id, '_event_location', true );
						$event_lat      = get_post_meta( $event_id, '_event_latitude', true );
						$event_lng      = get_post_meta( $event_id, '_event_longitude', true );
						?>
                        <div class="msd-events__item" id="event-<?php echo esc_attr( $event_id ); ?>"
                             data-event-id="<?php echo esc_attr( $event_id ); ?>">
                            <div class="msd-events__item__title"><?php the_title(); ?></div>
                            <p><strong>Date:</strong> <?php echo esc_html( $event_date ); ?></p>
                            <p><strong>Location:</strong> <?php echo esc_html( $event_location ); ?></p>
                            <div class="event-map"
                                 data-lat="<?php echo esc_attr( $event_lat ); ?>"
                                 data-lng="<?php echo esc_attr( $event_lng ); ?>"
                                 data-event-id="<?php echo esc_attr( $event_id ); ?>">
                            </div>
                            <p><?php the_excerpt(); ?></p>
                        </div>
					<?php
					endwhile;
				else :
					echo '<p>' . __( 'No upcoming events found.', 'msd-events' ) . '</p>';
				endif;
				wp_reset_postdata();
				?>
            </div>
        </div>
    </main>

    <script>
        function initMap() {
            const mapElement = document.getElementById("map");

            if (!mapElement) {
                return;
            }

            const map = new google.maps.Map(mapElement, {
                center: {lat: 50.0755, lng: 14.4378}, // Default center (Prague)
                zoom: 4,
                mapId: "map"
            });

            const markers = [];

            document.querySelectorAll(".event-map").forEach((eventMap) => {
                const lat = parseFloat(eventMap.getAttribute("data-lat"));
                const lng = parseFloat(eventMap.getAttribute("data-lng"));
                const eventId = eventMap.getAttribute("data-event-id");

                if (!isNaN(lat) && !isNaN(lng)) {
                    const marker = new google.maps.marker.AdvancedMarkerElement({
                        position: {lat, lng},
                        map: map,
                        title: "Event Location",
                    });

                    // Add click event to highlight the event
                    marker.addListener("click", () => {
                        highlightEvent(eventId);
                    });

                    markers.push(marker);
                }
            });

            if (markers.length > 1) {
                const bounds = new google.maps.LatLngBounds();
                markers.forEach((marker) => bounds.extend(marker.position));
                map.fitBounds(bounds);
            }
        }

        // Function to highlight the event when clicking on the marker
        function highlightEvent(eventId) {
            document.querySelectorAll(".msd-events__item").forEach(event => {
                event.classList.remove("msd-events__item--hl");
            });

            const eventElement = document.getElementById(`event-${eventId}`);
            if (eventElement) {
                eventElement.classList.add("msd-events__item--hl");
                eventElement.scrollIntoView({behavior: "smooth", block: "center"});
            }
        }

        // Ensure `initMap` is globally accessible
        window.initMap = initMap;
    </script>

<?php get_footer(); ?>