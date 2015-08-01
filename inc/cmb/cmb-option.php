<?php

function abs_sample_metaboxes( $meta_boxes ) {
    $prefix = '_wpxtts_'; // Prefix for all fields
    $meta_boxes['wpxt_metabox'] = array(
        'id' => 'wpxt_metabox',
        'title' => 'WPXT Testimonial Slider Metabox',
        'pages' => array('wpxt_slider'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Client Name',
                'desc' => 'You can set Client Name from here. ',
                'id' => $prefix . 'client_name',
                'type' => 'text'
            ),
            array(
                'name' => 'Position of Client',
                'desc' => 'You can set Position of Client from here.',
                'id' => $prefix . 'client_position',
                'type' => 'text'
            ),
			 array(
                'name' => 'Company Name of Client',
                'desc' => 'You can set Company Name of Client from here.',
                'id' => $prefix . 'company_name',
                'type' => 'text'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'abs_sample_metaboxes' );























?>