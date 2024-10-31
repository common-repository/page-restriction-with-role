<?php

class Prwr_functions {

    public static function get_permitted_pages( $user_id, $slugs ) {
        $assigned_role = get_user_meta( $user_id, 'prwr_assigned_role', true );
        if ( $assigned_role ) {
            $prwr_page_access_info = get_post_meta( $assigned_role, 'prwr_page_access_info', true );
        } else {
            return array();
        }
        !is_array( $prwr_page_access_info ) ? ( $prwr_page_access_info = array() ) : '' ;
        return array_intersect( array_keys( $prwr_page_access_info ), array_keys( $slugs ) );
    }
}