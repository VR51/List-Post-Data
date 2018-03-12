<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
*	This will be broken up into discrete components eventually. Keeping it all as one file for convenience for now.
**/

/**
* Human Table
**/

// Set display table headings. These are the headings of the Summary Details column data (below header code)
echo '<table class="vr51-lpd">';
echo '<tr>';
	$columns = array( '#', 'Icon', 'Menu Label', 'Internal Name', 'Single Item Name', 'Built In' );	
	foreach ( $columns as $column ) {
			echo '<th class="' . $column . '">' . $column . '</th>';
	}
echo '</tr>';

// Get all post types registered for current site (active or not, public or not)
$post_types = get_post_types( '', 'objects' );
$post_supports = file( PLUGIN_PATH . 'src/data/data-post-supports.txt', FILE_IGNORE_NEW_LINES );

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
	
	// Get the features the post type supports
	$supported = array();
	foreach ($post_supports as $supports) {
		$value = post_type_supports( $post_type->name, $supports );
		$supported[$supports] = "$value";
	}
	
	// Get the taxonomies used by the post
	$taxonomy_objects = get_object_taxonomies( $post_type->name, 'objects' );
	
	// Get raw list of terms for each taxonomy
	$terms_raw = array();
	$taxonomy_terms_raw = get_object_taxonomies( $post_type->name, 'names' );
	foreach ($taxonomy_terms_raw as $tax) {
		$term = get_terms( "$tax" );
		$terms_raw[$tax] = $term;
	}
	
	// Get nice list of terms used in each taxonomy
	$terms = array();
	$taxonomy_terms = get_object_taxonomies( $post_type->name, 'names' );
	foreach ($taxonomy_terms as $tax) {
		$data = get_terms( "$tax" );
		$count = count( $data );
		if ($count > 0) {
			foreach ( $data as $term ) {
				$newdata[] = $term->name;
			}
		}
		$terms[$tax] = $newdata;
	}

	// Build Data Table
	echo '<tr id="vr51-lpd-' . $c . '" data-row="' . $c . '">';
		echo '<td class="odd"><span>' . $c . '</span>'; // Row number
			echo '<div class="details vr51-lpd-' . $c . '">'; // On-hover details
				echo '<div class="inner">';
					echo '<div class="header">';
						echo '<span class="label">' . $post_type->label . '</span>';
						echo '<span class="divider"> | </span>';
						echo '<span class="name">' . $post_type->name . '</span>';
						echo '<div class="counts">' . $post_counts . '</div>';
					echo '</div>';
					echo '<div class="body">';
						echo '<h3>Post Type Data</h3>'; // Arrary dump
						echo '<pre>';
							print_r( $details );
						echo '</pre>';
						echo '<h3>Post Type Supports</h3>'; // Array dump
						echo '<pre>'; // Arrary dump
							print_r( $supported );
						echo '</pre>';
						echo '<h3>Post Type Taxonomies</h3>'; // Array dump
						echo '<pre>'; // Arrary dump
							print_r( $taxonomy_objects);
						echo '</pre>';
						echo '<h3>Post Taxonomy Details</h3>'; // Array dump
						echo '<pre>'; // Arrary dump
							print_r( $terms_raw);
						echo '</pre>';
						echo '<h3>Post Taxonomy Terms</h3>'; // Array dump
						echo '<pre>'; // Arrary dump
							print_r( $terms);
						echo '</pre>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</td>';
		// Summary Details
		echo '<td class="even"><span class="' . $post_type->menu_icon . '" style="font-family:dashicons;"></span></td>';
		echo '<td class="odd"><span>' . $post_type->label . '</span></td>';
		echo '<td class="even"><span>' . $post_type->name . '</span></td>';
		echo '<td class="odd"><span>' . $post_type->labels->singular_name . '</span></td>';
		echo '<td class="even"><span>' . $post_type->_builtin . '</span></td>';
	echo '</tr>';
	$c+=1;
}

echo '</table>';