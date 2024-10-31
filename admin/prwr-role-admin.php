<?php

class Prwr_role_admin extends Base_admin {

    function __construct() {
        parent::__construct();
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxed_function' ) );
        add_action( 'save_post', array( $this, 'save_post_function' ), 10, 3 );
    }


    function add_meta_boxed_function( $post_type ) {
        if ( $post_type == 'prwr_role' ) {
            add_meta_box( 'prwr_role-page-access', 'Mange Page Accessibility', array( $this, 'render_pages_panel' ), 'prwr_role' , 'advanced', 'high' );
        }
    }


    function render_pages_panel ( $post ) {
        wp_nonce_field( 'prwr_page_access_custom_box', 'prwr_page_access_nonce' );
        $prwr_page_access_info = get_post_meta( $post->ID, 'prwr_page_access_info', true ); ?>

        <div class="$prwr_role_manager">
            <table>
                <tr><th>Page Name</th></tr>
                <?php foreach ( $this->slugs as $slug => $label ) : ?>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="prwr_page[<?php echo $slug; ?>]" class="lms_page_check" value="true" <?php echo isset ( $prwr_page_access_info[$slug] ) && $prwr_page_access_info[$slug] == 'true' ? 'checked' : ''; ?> />
                                <?php echo $label; ?>
                            </label>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php
    }



    function save_post_function(  $post_id, $post, $update ) {

        global $current_user;

        if ( !isset ( $current_user->caps['administrator'] ) || $current_user->caps['administrator'] != true ) {
            return $post_id;
        }
        // Check if our nonce is set.
        if ( ! isset( $_POST['prwr_page_access_nonce'] ) )
            return $post_id;

        $nonce = $_POST['prwr_page_access_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'prwr_page_access_custom_box' ) )
            return $post_id;


        // Check the user's permissions.
        if ( 'prwr_role' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;

        }

        update_post_meta( $post_id, 'prwr_page_access_info', $_POST['prwr_page'] );
    }



    public static function init() {
        global $pagenow;
        if ( $pagenow == 'post.php' ) {
            $new_instance = new Prwr_role_admin();
        }
    }
}

Prwr_role_admin::init();