<?php

function __construct() {
    
vc_add_shortcode_param( 'hvc_notice', 'atvc_notice_filed_type' );
function atvc_notice_filed_type( $settings, $value ) {
   return '<div class="hvc_notice">
                
                <h1>Raju</h1>
                
            </div>';
    }

}