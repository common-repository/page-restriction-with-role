<?php

class Prwr_user_admin {

    function __construct() {
        add_action( 'show_user_profile', array($this, 'assign_role_panel'), 10 );
        add_action( 'edit_user_profile', array($this, 'assign_role_panel'), 10 );
        add_action( 'personal_options_update', array($this, 'assign_role_update') );
        add_action( 'edit_user_profile_update', array($this, 'assign_role_update') );
    }


    /**
     * Assign role panel to user profile
     */
    function assign_role_panel( $profileuser ) {
        $user_id = get_current_user_id();
        $userdata = get_userdata($user_id);

        if( !in_array( 'administrator', $userdata->roles ) ) {
            return;
        }

        $prwr_assigned_role = get_user_meta( $profileuser->ID, 'prwr_assigned_role', true );
        $roles = get_posts( array( 'post_type' => 'prwr_role' ) ); ?>
        <h3>Assign Role to this user</h3>
        <?php wp_nonce_field( 'prwr_user_access_custom_box', 'prwr_user_access_nonce' ); ?>

        <select name="prwr_role">
            <option value="">Select</option>
            <?php foreach ($roles as $key => $role) : ?>
                <option value="<?php echo $role->ID; ?>" <?php echo $prwr_assigned_role == $role->ID ? 'selected' : '';  ?> ><?php echo $role->post_title; ?></option>
            <?php endforeach; ?>
        </select>
    <?php
    }


    /**
     * update the role assigned to the user
     */
    function assign_role_update( $user_id ) {
        if ( !is_admin() && !current_user_can( 'edit_users' ) ) {
            return;
        }

        // Check if our nonce is set.
        if ( ! isset( $_POST['prwr_user_access_nonce'] ) )
            return $user_id;

        $nonce = $_POST['prwr_user_access_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'prwr_user_access_custom_box' ) )
            return $user_id;

        update_user_meta( $user_id, 'prwr_assigned_role',  $_POST['prwr_role'] );
    }


    public static function init() {
        global $pagenow;
        if ( $pagenow == 'user-edit.php' || $pagenow == 'profile.php' ) {
            $new_instance = new Prwr_user_admin();
        }
    }
}

Prwr_user_admin::init();

