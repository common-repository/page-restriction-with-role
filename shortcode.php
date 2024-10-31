<?php

class Prwr_shortcode extends Prwr_base_frontend {

    private $permitter_page_slugs;

    function __construct() {
        parent::__construct();
        add_action('init', array( $this, 'register_url') ) ;

        add_shortcode( 'prwr_menu', array( $this, 'prwr_menu_runner') );
        add_shortcode( 'prwr_pages', array( $this, 'prwr_pages_runner') );
    }

    function register_url(){
        foreach ( $this->slugs as $slug => $label ) {
            add_rewrite_endpoint( $slug, EP_ALL );
        }
    }


    function prwr_menu_runner( $atts ) {

        if ( !is_user_logged_in() ) {
            return;
        } else {
            $this->permitted_page_slugs = Prwr_functions::get_permitted_pages( get_current_user_id(), $this->slugs );
            ?>
            <div class="prwr-page-slugs">
                <ul>
                    <?php
                    foreach ( $this->permitted_page_slugs as $slug ) {
                        ?>
                        <li><a href="<?php echo esc_url( add_query_arg( 'prwr-page', $slug ) ); ?>"><?php echo $this->slugs[$slug];?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }

    }

    function prwr_pages_runner( $atts ) {

        if ( empty( $this->permitted_page_slugs ) ) {
            $this->permitted_page_slugs = Prwr_functions::get_permitted_pages( get_current_user_id(), $this->slugs );
        }

        ?>
        <div class="prwr-page-content">
            <?php
            if ( isset ( $_GET[ 'prwr-page' ] ) && in_array( $_GET['prwr-page'], $this->permitted_page_slugs ) ) {
                if ( isset ( $this->slugs[$_GET[ 'prwr-page' ] ] ) ) {
                    include 'templates/'.$_GET[ 'prwr-page' ].'.php';
                }
            } else {
                if ( !isset( $_GET[ 'prwr-page' ] ) ) {
                    isset( $this->permitted_page_slugs[0] ) ? include 'templates/'.$this->permitted_page_slugs[0].'.php' : '';
                } else {
                    echo 'You don\'t have permission to access this page !';
                }

            }
            ?>
        </div>
<?php
    }

    function prwr_shortcode_runner( $atts ) {

    }

    public static function init() {
        $new_instance =  new Prwr_shortcode();
    }

}


Prwr_shortcode::init();
