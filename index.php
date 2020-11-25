<?php 
/*
Plugin Name: Silck Slide
Version: 2.0.1
Author: Minar Khan
*/

function silck_post_type(){

	
		$labels = array(
			'name'               => __( 'Silck Slides', 'text-domain' ),
			'singular_name'      => __( 'Silck Slide', 'text-domain' ),
			'add_new'            => _x( 'Add New Silck Slide', 'text-domain', 'text-domain' ),
			'add_new_item'       => __( 'Add New Silck Slide', 'text-domain' ),
			'edit_item'          => __( 'Edit Silck Slide', 'text-domain' ),
			'new_item'           => __( 'New Silck Slide', 'text-domain' ),
			'view_item'          => __( 'View Silck Slide', 'text-domain' ),
			'search_items'       => __( 'Search Silck Slides', 'text-domain' ),
			'not_found'          => __( 'No Silck Slides found', 'text-domain' ),
			'not_found_in_trash' => __( 'No Silck Slides found in Trash', 'text-domain' ),
			'parent_item_colon'  => __( 'Parent Silck Slide:', 'text-domain' ),
			'menu_name'          => __( 'Silck Slides', 'text-domain' ),
		);
	
		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'description'         => 'description',
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => null,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
				'editor',
				'thumbnail')
		);
	
		register_post_type( 'silck_slide', $args );


		$labels = array(
        'name' => __( 'Genres' , 'tutsplus' ),
        'singular_name' => __( 'Genre', 'tutsplus' ),
        'search_items' => __( 'Search Genres' , 'tutsplus' ),
        'all_items' => __( 'All Genres' , 'tutsplus' ),
        'edit_item' => __( 'Edit Genre' , 'tutsplus' ),
        'update_item' => __( 'Update Genres' , 'tutsplus' ),
        'add_new_item' => __( 'Add New Genre' , 'tutsplus' ),
        'new_item_name' => __( 'New Genre Name' , 'tutsplus' ),
        'menu_name' => __( 'Genres' , 'tutsplus' ),
    );
     
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'genres' ),
        'show_admin_column' => true,
        'show_in_rest' => true
 
    );
     
    register_taxonomy( 'slick_genre', array( 'silck_slide' ), $args);

	

}
add_action( 'init', 'silck_post_type' );



function silck_link_script(){
	
  
  wp_enqueue_style( 'silck_style', plugin_dir_url( __FILE__ ) .  '/slick/slick-theme.css' );
  wp_enqueue_style( 'silck_theme', plugin_dir_url( __FILE__ ) .  '/slick/slick.css' );
  wp_enqueue_style( 'silck_cus', plugin_dir_url( __FILE__ ) .  '/slick/style.css' );
  wp_enqueue_script( 'slick_script', plugin_dir_url( __FILE__ ) .  '/slick/slick.js', array ('jquery', 'jquery-ui'));
  wp_enqueue_script( 'slick_custom', plugin_dir_url( __FILE__ ) .  '/slick/script.js' );



}
add_action( 'wp_enqueue_scripts', 'silck_link_script');



function slick_slide_show(){

	$result = '<section class="lazy slider" data-sizes="50vw">';
	$slick = new WP_Query(array('post_type' => 'silck_slide' ));
	if($slick->have_posts()):
	while($slick->have_posts()): $slick->the_post();

	$featured_img_url = get_the_post_thumbnail_url($slick->get_the_ID(),'full');
	$result.= '<div>';
	$result .= ' <img  data-lazy="' . $featured_img_url . '" data-srcset="' . $featured_img_url . '">';
	$result.= '</div>';

	endwhile;
	endif;
	$result .= '</section>';
	return $result;
}

add_shortcode( 'slick_slide', 'slick_slide_show' );








 ?>