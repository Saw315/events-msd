<?php
/**
 * Template Name: Upcoming Events
 */

get_header();

?>

<main class="msd-events">
    <h1><?php _e( 'Upcoming Events', 'msd-events' ); ?></h1>

    <div class="msd-events__content">
		<?php
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

		if ( $events->have_posts() ) :
			while ( $events->have_posts() ) : $events->the_post();
				$event_date      = get_post_meta( get_the_ID(), '_event_date', true );
				$event_location  = get_post_meta( get_the_ID(), '_event_location', true );
				$event_latitude  = get_post_meta( get_the_ID(), '_event_latitude', true );
				$event_longitude = get_post_meta( get_the_ID(), '_event_longitude', true );
				?>
                <div class="msd-events__item">
                    <div class="msd-events__item__title"><?php the_title(); ?></div>
                    <p><strong>Date:</strong> <?php echo esc_html( $event_date ); ?></p>
                    <p><strong>Location:</strong> <?php echo esc_html( $event_location ); ?></p>
                    <div class="event-map" data-lat="<?php echo esc_attr( $event_latitude ); ?>"
                         data-lng="<?php echo esc_attr( $event_longitude ); ?>"></div>
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

    <div id="map"></div>

</main>

<?php get_footer(); ?>
