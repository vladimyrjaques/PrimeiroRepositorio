<?php
vc_map(array(
    "name" 			=> "App Screenshots Carousel",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_screenshots",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array( 
    
        array(
            'type' => 'param_group',
            'heading' => __( 'Screenshot Images', 'js_composer' ),
            'param_name' => 'images',
            
            'params' => array(
                array(
                    "type" => "attach_image",
                    "heading" => __("Image", "tavc"),
                    "param_name" => "image",
                    "admin_label" => true,
                    "value" => "",
                    "description" => __("perfect size is: 375x812", "tavc")
                ),
            ),
        ),
                          
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'tavc'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'tavc')
        ),        

    )
    
));

function atvc_screenshots_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'images' => '',        
        'el_class' =>'',

    ), $atts));    
    
    
    $images = vc_param_group_parse_atts($images);

    $output ='';
    
    $image_html ='';
    if ($images !== ''){
        foreach ($images as $image) {
            $image = wp_get_attachment_image_src( $image['image'], 'full' );
            $image_html .= '<div class="single-screenshort-item">
                            	<img src="'.$image[0].'" alt="">  
                            </div>';
        }
    }
        
    $shape1 = ATVC_PLUGIN_URL . 'assets/img/08.png';
    $shape2 = ATVC_PLUGIN_URL . 'assets/img/09.png';
        
    $output .= '<section class="screenshort-area '.$el_class.'">
        <div class="shape-1"><img src="'.$shape1.'" alt=""></div>
        <div class="shape-2"><img src="'.$shape2.'" alt=""></div>
        <div class="screenshort-carousel">
        
            '.$image_html.'
        
        </div>
        </section>';
    

    return $output;
}

add_shortcode("atvc_screenshots", "atvc_screenshots_shortcode");