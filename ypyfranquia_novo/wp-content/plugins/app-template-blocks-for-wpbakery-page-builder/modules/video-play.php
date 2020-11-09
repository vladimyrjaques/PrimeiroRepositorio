<?php
vc_map(array(
    "name" 			=> "Video Popup",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_video_play",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array( 
        array(
            "type" => "textfield",
            "heading" => __("Video Url", 'tavc'),
            "param_name" => "video_url",
            'admin_label' => true,
            'value' => 'https://www.youtube.com/watch?v=SGP6Y0Pnhe4',
            "description" => __("Insert youtube video url, Ex: https://www.youtube.com/watch?v=SGP6Y0Pnhe4", 'tavc')
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Video Image", "tavc"),
            "param_name" => "image",
            "admin_label" => true,
            "value" => "",
            "description" => __("Perfect image size is 554x496", "tavc")
        ),                  
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'tavc'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'tavc')
        ),        

    )
    
));

function atvc_video_play_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'video_url' => '',     
        'image' => '',     
        'el_class' =>'',

    ), $atts));    
    
    
    $image = wp_get_attachment_image_src( $image, 'full' );

    // Load VC icons libraries
    vc_iconpicker_editor_jscss();
        
        
    $output = '<div class="img-with-video">
                    <div class="img-wrap">
                        <img src="'.$image[0].'" alt="">
                        <div class="hover">
                            <a href="'.$video_url.'" class="video-play-btn mfp-iframe"><i class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>';
    

    return $output;
}

add_shortcode("atvc_video_play", "atvc_video_play_shortcode");