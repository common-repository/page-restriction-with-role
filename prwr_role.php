<?php

class Prwr_role {

    function __construct() {
        add_action( 'init', array( $this, 'register_prwr_role' ) );
    }


    function register_prwr_role() {
        register_post_type( 'prwr_role', array(
            'labels'             => array(
                'name'               => _x( 'Additional Role', 'post type general name', 'lms' ),
                'singular_name'      => _x( 'Additional Role', 'post type singular name', 'lms' ),
                'menu_name'          => _x( 'Additional Role', 'admin menu', 'lms' ),
                'name_admin_bar'     => _x( 'Additional Role', 'add new on admin bar', 'lms' ),
                'add_new'            => _x( 'Add New', 'Additional Role', 'lms' ),
                'add_new_item'       => __( 'Add New Additional Role', 'lms' ),
                'new_item'           => __( 'New Additional Role', 'lms' ),
                'edit_item'          => __( 'Edit Additional Role', 'lms' ),
                'view_item'          => __( 'View Additional Role', 'lms' ),
                'all_items'          => __( 'All Additional Roles', 'lms' ),
                'search_items'       => __( 'Search Additional Roles', 'lms' ),
                'parent_item_colon'  => __( 'Parent Additional Roles:', 'lms' ),
                'not_found'          => __( 'No Additional Roles found.', 'lms' ),
                'not_found_in_trash' => __( 'No Additional Roles found in Trash.', 'lms' )
            ),
            'description'        => __( 'Description.', 'prwr' ),
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'prwr-role' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title' )
        ) );
    }
}

new Prwr_role();