<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function vr51_lpd_shortcode() {
	
	/**
	* Human Table
	**/
	
	echo '<table class="vr51-lpd">';
	echo '<tr>';
			// Set display table headings
			$columns = array( '#', 'Icon', 'Menu Label', 'Internal Name', 'Single Item Name', 'Built In' );
			foreach ( $columns as $column ) {
					echo '<th class="' . $column . '">' . $column . '</th>';
			}
	echo '</tr>';

	// Get all post types registered for current site (active or not, public or not)
	$post_types = get_post_types( '', 'objects' );
	
	$c=1; // Count loops
	foreach ( $post_types as $post_type ) {
			
			// Get array of details of each post type
			$name = $post_type->name;
			$details = get_post_type_object( "$name" );

			// Get all post counts
			$count_posts = wp_count_posts( "$name" );

			ob_start();
					foreach ($count_posts as $key => $value) {
							echo '<span class="count">' . $key . ': ' . $value . '</span>';
					}
			$post_counts = ob_get_clean();
			
			echo '<tr id="vr51-lpd-' . $c . '" data-row="' . $c . '">';
					echo '<td class="odd"><span>' . $c . '</span>'; // Row number
							echo '<div class="details vr51-lpd-' . $c . '"><div class="inner">'; // On-hover details
						echo '<div class="header">';
							echo '<span class="label">' . $post_type->label . '</span>';
							echo '<span class="divider"> | </span>';
							echo '<span class="name">' . $post_type->name . '</span>';
							echo '<div class="counts">' . $post_counts . '</div>';
						echo '</div>';
								echo '<pre>'; // Arrary dump
								print_r( $details );
								echo '</pre>';
					echo '</div></div>';
					echo '</td>';
				// Summary details
					echo '<td class="even"><span class="' . $post_type->menu_icon . '" style="font-family:dashicons;"></span></td>';
					echo '<td class="odd"><span>' . $post_type->label . '</span></td>';
					echo '<td class="even"><span>' . $post_type->name . '</span></td>';
					echo '<td class="odd"><span>' . $post_type->labels->singular_name . '</span></td>';
					echo '<td class="even"><span>' . $post_type->_builtin . '</span></td>';
			echo '</tr>';
			$c+=1;
	}

	echo '</table>';

}