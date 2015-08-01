<?php

/*
Plugin Name: WEXT Testimonial Slider
Plugin URI: http://www.absiddik.net/plugins/wext-t-slider
Description: The WEXT Testimonial Slider is most popular & best free testimonial slider plugin.If you are thinking to build a testimonial slider in your website, then WEXT Testimonial Slider plugin is most required to you for taking your conversion rate to the next level. 
Author: AB Siddik
Version: 1.0
Author URI: http://wexteam.com
*/


/*-----------------------------------------------------
 *Latest Jquery For WEXT Testimonial Slider Plugin.
 -------------------------------------------------------*/
function wext_cli_tes_slider_latest_jquery() {
	wp_enqueue_script( 'jquery' );
}
add_action( 'init', 'wext_cli_tes_slider_latest_jquery' );


/*---------------------
 *Some predefine Set-up
 -----------------------*/
define('WPXT_CLIENT_TEST_WP_PlUGIN', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );



/*------------------------------------------------------------
 * Main Jquery and Style for WEXT Testimonial Slider  Plugin
 -------------------------------------------------------------*/
function wpxt_cli_tes_slider_main_jquery() {

	wp_enqueue_script( 'wext-fxslider-js',WPXT_CLIENT_TEST_WP_PlUGIN.'js/jquery.flexslider-min.js', array('jquery'), 1.0, false);
	
	wp_enqueue_script( 'wext-mesonary-js',WPXT_CLIENT_TEST_WP_PlUGIN.'js/masonry.pkgd.min.js', array('jquery'), 1.0, false);
	
	wp_enqueue_script( 'wext-active-js',WPXT_CLIENT_TEST_WP_PlUGIN.'js/active.js', array('jquery'), 1.0, false);

	wp_enqueue_style( 'wext-main-css', WPXT_CLIENT_TEST_WP_PlUGIN.'css/slider.css');
	
	
}

add_action( 'init', 'wpxt_cli_tes_slider_main_jquery' );


/*--------------------------------------------------
 *Thumbonial Support  WEXT Testimonial Slider  plugin
 ----------------------------------------------------*/
add_theme_support( 'post-thumbnails','' );

add_image_size( 'author_img',50,50, true );

//include_once('inc/optional-panel.php');

include_once('inc/wpxt-wedget.php');

// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( 'inc/cmb/init.php' );
    }
}

// Custom metaboxs option
require_once('inc/cmb/cmb-option.php');



/*---------------------------------------------------
 *This custom post for  WEXT Testimonial Slider Plugin
 ----------------------------------------------------*/
add_action( 'init', 'wpxt_client_testmonial_slider_post' );

function wpxt_client_testmonial_slider_post() {
	$labels = array(
		'name'               => _x( 'Testimonial Slider', 'wext-testimonial-slider' ),
		'singular_name'      => _x( 'Testimonial Slide',  'wext-testimonial-slider' ),
		'menu_name'          => _x( 'Testimonial Slider', 'wext-testimonial-slider' ),
		'name_admin_bar'     => _x( 'Testimonial Slide',  'wext-testimonial-slider' ),
		'add_new'            => _x( 'Add New Slide Item', 'wext-testimonial-slider' ),
		'add_new_item'       => __( 'Add New Slide Item', 'wext-testimonial-slider' ),
		'new_item'           => __( 'New Slider Items', 'wext-testimonial-slider' ),
		'edit_item'          => __( 'Edit Slide Item', 'wext-testimonial-slider' ),
		'view_item'          => __( 'View Slide Item', 'wext-testimonial-slider' ),
		'all_items'          => __( 'All Slide Items', 'wext-testimonial-slider' ),
		'search_items'       => __( 'Search Slide', 'wext-testimonial-slider' ),
		'parent_item_colon'  => __( 'Parent Slide:', 'wext-testimonial-slider' ),
		'not_found'          => __( 'No Slide Items found.', 'wext-testimonial-slider' ),
		'not_found_in_trash' => __( 'No Slide Items found in Trash.', 'wext-testimonial-slider' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial-slide' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields',)
	);

	register_post_type( 'wpxt_slider', $args );
}


/*--------------------------------------------------------
 *Shortcode for WEXT Testimonial Slider layout for part one
 ---------------------------------------------------------*/
add_action( 'init', 'register_shortcodes');
function register_shortcodes(){
   add_shortcode('first-part', 'wpxt_testimonial_slider_function_one');
}


function wpxt_testimonial_slider_function_one(){

	$q = new WP_Query(
		array('posts_per_page' => 10,'post_type'=> 'wpxt_slider', ));	

		//use for some custo
	
	$list = '<div class="cd-testimonials-wrapper cd-container">
				<ul class="cd-testimonials">';
	while($q->have_posts()) : $q->the_post();
	$idd = get_the_ID();
	
	global $post;
	$client_name = get_post_meta($idd, '_wpxtts_client_name', true );
	$client_position = get_post_meta($idd, '_wpxtts_client_position', true );
	$company_name = get_post_meta($idd, '_wpxtts_company_name', true );
	
	$author_picture = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'author_img' );
		
		$list .= '
		
		<li>
			<p>'.get_the_content().'</p>
			<div class="cd-author">
				<img src="'.$author_picture[0].'" alt="Author image">
				<ul class="cd-author-info">
					<li>' .$client_name.'</li>
					<li>' .$client_position.', ' .$company_name.'</li>
				</ul>
			</div>
		</li>
		
		';        
	endwhile;
	$list.= '</ul>
	<a href="#0" class="cd-see-all">See all</a>
	</div>
	
	';
	wp_reset_query();
	return $list;



}

/*----------------------------------------------------------
 *Shortcode for WEXT Testimonial Slider layout for part tow
 -----------------------------------------------------------*/
add_action( 'init', 'register_shortcodes_tow');
function register_shortcodes_tow(){
   add_shortcode('second-part', 'wpxt_testimonial_slider_function_tow');
}


function wpxt_testimonial_slider_function_tow(){

	$q = new WP_Query(
		array('posts_per_page' => -1,'post_type'=> 'wpxt_slider'));	

		//use for some custo
			
		
		
	$list = '<div class="cd-testimonials-all">
				<div class="cd-testimonials-all-wrapper">
					<ul>';
	while($q->have_posts()) : $q->the_post();
	$idd = get_the_ID();
	
	global $post;	
	$client_name = get_post_meta($idd, '_wpxtts_client_name', true );
	$client_position = get_post_meta($idd, '_wpxtts_client_position', true );
	$company_name = get_post_meta($idd, '_wpxtts_company_name', true );
	
	$author_picture = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'author_img' );
		
		$list .= '
		
		<li class="cd-testimonials-item">
				<p>'.get_the_content().'</p>
				
				<div class="cd-author">
					<img src="'.$author_picture[0].'" alt="Author image">
					<ul class="cd-author-info">
						<li>'.$client_name.'</li>
						<li>' .$client_position.', ' .$company_name.'</li>
					</ul>
				</div> <!-- cd-author -->
			</li>
		
		';        
	endwhile;
	$list.= '		</ul>
				</div>	<!-- cd-testimonials-all-wrapper -->
				<a href="#0" class="close-btn">Close</a>
			</div>
			';
	wp_reset_query();
	return $list;


}

/*---------------------------------------------------------
 *Shortcode for WEXT Testimonial Slider layout for main part
 -----------------------------------------------------------*/
add_action( 'init', 'register_shortcodes_main');

function register_shortcodes_main(){
   add_shortcode('wext-slider', 'wpxt_testimonial_slider_function_main');
}

function wpxt_testimonial_slider_function_main(){
	echo '<div class="test_slider">';
	echo do_shortcode( '[first-part][second-part]' );
	echo '</div>';
}

/*--------------------------------
 *
 */
 add_action( 'admin_head', 'replace_default_featured_image_meta_box', 100 );
function replace_default_featured_image_meta_box() {
    remove_meta_box( 'postimagediv', 'wpxt_slider', 'side' );
    add_meta_box('postimagediv', __('Client Image'), 'post_thumbnail_meta_box', 'wpxt_slider', 'side', 'high');
}



?>