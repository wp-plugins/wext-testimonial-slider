<?php

// Creating the widget 
class wpxt_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpxt_widget', 

// Widget name will appear in UI
__('WPXT Testimonial Slider', 'wpxt_testimonial_slider'), 

// Widget description
array( 'description' => __( 'A widget for WPXT Testimonial Slider', 'wpxt_testimonial_slider' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo do_shortcode( '[wext-slider]' );


echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Testimonial', 'wpxt_testimonial_slider' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />


<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpxt_widget ends here

// Register and load the widget
function wpxt_load_widget() {
	register_widget( 'wpxt_widget' );
}
add_action( 'widgets_init', 'wpxt_load_widget' );






// Creating the widget 
class wpxtts_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wpxtts_widget', 

// Widget name will appear in UI
__('WPXT Testimonial Slider', 'wpxt_testimonial_slider'), 

// Widget description
array( 'description' => __( 'A widget for WPXT Testimonial Slider', 'wpxt_testimonial_slider' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

 ?>
 <style type="text/css">
	.custom_wedget_list li{list-style:none;}
	.custom_wedget_list li h2{font-wight:bold; font-size:20px;}
 </style>
 <ul class="custom_wedget_list">
<?php $the_query = new WP_Query( 'showposts=3' ); ?>
<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
<li><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></li>
<li><?php echo get_excerpt(120); ?></li>
<?php endwhile;?>
</ul>


<?php


echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Testimonial', 'wpxt_testimonial_slider' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />


<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpxt_widget ends here

// Register and load the widget
function abs_load_widget() {
	register_widget( 'wpxtts_widget' );
}
add_action( 'widgets_init', 'wpxt_load_widget' );

?>