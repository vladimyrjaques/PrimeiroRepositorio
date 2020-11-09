<?php
/*
Plugin Name: App Template Blocks for WPBakery Page Builder
Plugin URI: https://codenpy.com/item/app-template-blocks-for-wpbakery-page-builder/
Description: Modern app landing page template addons allow you to make professional app showcase page with the power of WPBakery page builder. 
Author: codenpy
Author URI: https://codenpy.com/
License: GPLv2 or later
Text Domain: atvc
Version: 1.0.8
*/

// Don't load directly
if (!defined('ABSPATH')){die('-1');}

define( 'ATVC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ATVC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'js_composer/js_composer.php' ) ){
    
    //require_once ('inc/framework/cs-framework.php');        
    require_once ('admin/index.php');        
    require_once ('admin/google-fonts.php');        
    
    //Loading CSS
    function atvc_business_template_styles() {
        
        // CSS
        wp_enqueue_style('atvc-grid', plugins_url( '/assets/css/flexboxgrid.css' , __FILE__ ) );
        wp_enqueue_style('atvc-font-awesome', plugins_url( '/assets/css/fontawesome.5.7.2.css' , __FILE__ ) );
        wp_enqueue_style('atvc-animate', plugins_url( '/assets/css/animate.css' , __FILE__ ) );
        wp_enqueue_style('atvc-owl-carousel', plugins_url( '/assets/css/owl.carousel.min.css' , __FILE__ ) );
        wp_enqueue_style('atvc-flaticon', plugins_url( '/assets/css/flaticon.css' , __FILE__ ) );
        wp_enqueue_style('atvc-magnific-popup', plugins_url( '/assets/css/magnific-popup.css' , __FILE__ ) );
        wp_enqueue_style('atvc-style', plugins_url( '/assets/css/style.css' , __FILE__ ) );
        wp_enqueue_style('atvc-custom', plugins_url( '/assets/css/custom.css' , __FILE__ ) );
        wp_enqueue_style('atvc-responsive', plugins_url( '/assets/css/responsive.css' , __FILE__ ) );
        
        // JS
        wp_enqueue_script('atvc-counterup-js', plugins_url('/assets/js/jquery.counterup.min.js', __FILE__), array('jquery'),'1.0.0', true);
        wp_enqueue_script('atvc-magnific-popup-js', plugins_url('/assets/js/jquery.magnific-popup.js', __FILE__), array('jquery'),'1.0.0', true);
        wp_enqueue_script('atvc-owl-carousel-js', plugins_url('/assets/js/owl.carousel.min.js', __FILE__), array('jquery'),'1.0.0', true);
        wp_enqueue_script('atvc-popper-js', plugins_url('/assets/js/popper.min.js', __FILE__), array('jquery'),'1.0.0', true);
        wp_enqueue_script('atvc-wow-js', plugins_url('/assets/js/wow.min.js', __FILE__), array('jquery'),'1.0.0', true);
        wp_enqueue_script('atvc-waypoints-js', plugins_url('/assets/js/waypoints.min.js', __FILE__), array('jquery'),'1.0.0', true);
        wp_enqueue_script('atvc-main-js', plugins_url('/assets/js/main.js', __FILE__), array('jquery'),'1.0.0', true);
 
 
    }
    add_action( 'wp_enqueue_scripts', 'atvc_business_template_styles' );    

    // Admin Style CSS
    function atvc_admin_enqeue() {
        
        wp_enqueue_style( 'atvc_admin_css', plugins_url( 'admin/admin.css', __FILE__ ) );
    }
    add_action( 'admin_enqueue_scripts', 'atvc_admin_enqeue' );

    // Initialize app template addons
    add_action( 'vc_before_init', 'init_atvc_addon' );
    function init_atvc_addon() {
        
        //Loading Addons
        require_once( 'modules/hero-section.php' );
        require_once( 'modules/heading.php' );
        require_once( 'modules/features.php' );
        require_once( 'modules/app-download-btn.php' );
        require_once( 'modules/video-play.php' );
        require_once( 'modules/counter.php' );
        require_once( 'modules/info-box.php' );
        require_once( 'modules/screenshots.php' );
        require_once( 'modules/testimonial.php' );
        require_once( 'modules/pricing-table.php' );
        require_once( 'modules/team-member.php' );
        
        
        
        
        //Loading Templates
        require_once( 'inc/templates/app.php' );
         
    }
}
// Check If VC is activate
else {
    function atvc_required_plugin() {
        if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'js_composer/js_composer.php' ) ) {
            add_action( 'admin_notices', 'atvc_required_plugin_notice' );

            deactivate_plugins( plugin_basename( __FILE__ ) ); 

            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }

    }
    add_action( 'admin_init', 'atvc_required_plugin' );

    function atvc_required_plugin_notice(){
        ?><div class="error"><p>Error! you need to install or activate the <a target="_blank" href="https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=themebonwp">WPBakery Page Builder for WordPress (formerly Visual Composer)</a> plugin to run "<span style="font-weight: bold;">App Template Blocks for WPBakery Page Builder</span>" plugin.</p></div><?php
    }
}
?>