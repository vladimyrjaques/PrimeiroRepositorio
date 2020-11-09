<?php
vc_map(array(
    "name" 			=> "Testimonial",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_testimonial",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array(
        
        array(
            'type' => 'param_group',
            'heading' => __( 'Testimonial Groups', 'js_composer' ),
            'param_name' => 'testimonials',
            'params' => array(
                array(
                    'type' => 'textarea',
                    'heading' => __( 'Testimonial Text', 'js_composer' ),
                    'param_name' => 'text',
                    'description' => __( '', 'js_composer' ),
                    'value' => '',
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Person Name", 'tavc'),
                    "param_name" => "name",
                    "admin_label" => true,
                    "description" => __("", 'tavc')
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Designation", 'tavc'),
                    "param_name" => "desig",
                    "description" => __("Leave empty if you dont want", 'tavc')
                ),
                array(
                    "type" => "attach_image",
                    "heading" => __("Person Image", "tavc"),
                    "param_name" => "image",
                    "value" => "",
                    "description" => __("", "tavc")
                ),                
            ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Name Font", "asvc"),
            "param_name" => "heading_font",
            "value" => atvc_google_font(),
            //"std" => 'Advent+Pro',
            'group' => 'Styles',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Name Font Size", 'tavc'),
            "param_name" => "heading_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Name Font color", "asvc" ),
            "param_name"  => "heading_color",
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Name Font Style", "asvc"),
            "param_name" => "heading_font_style",
            "value" => array(
                "None" => "",
                "Italic" => "italic",
            ),
            "group"       => "Styles"
        ),
        array(
            "type" => "hvc_notice",
            "class" => "",
            'heading' => __('<h3 class="hvc_notice" align="center">Texts Font Styles</h3>', 'hvc'),
            "param_name" => "hvc_notice_param_1",
            "value" => '',
            "group"       => "Styles"
        ),                                 
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Description Font", "asvc"),
            "param_name" => "desc_font",
            "value" => atvc_google_font(),
            'group' => 'Styles',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Texts Font Size", 'tavc'),
            "param_name" => "desc_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Description Font color", "asvc" ),
            "param_name"  => "desc_color",
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Description Font Style", "asvc"),
            "param_name" => "desc_font_style",
            "value" => array(
                "None" => "",
                "Italic" => "italic",
            ),
            "group"       => "Styles"
        ),        
        array(
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'tavc'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'tavc')
        ),        

    )
    
));

function atvc_testimonial_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'testimonials' => '',
        'heading_font' => '',
        'heading_f_size' => '',
        'heading_color' => '',
        'heading_font_style' => '',
        'desc_font' => '',
        'desc_f_size' => '',
        'desc_color' => '',
        'desc_font_style' => '',        
        'el_class' =>'',

    ), $atts));    

    $output = '';      


    $heading_styles = '';
    if($heading_font != ''){
        $output .= '<style>@import url(https://fonts.googleapis.com/css?family='.$heading_font.');</style>';
    }
    if($heading_font != ''){
        $heading_font = str_replace('+', ' ', $heading_font);
        $heading_styles .= ' font-family: '.$heading_font.'; ';
    }
    if(!empty($heading_f_size)){
        $heading_styles .= ' font-size: '.$heading_f_size.'px; ';
    }    
    if(!empty($heading_color)){
        $heading_styles .= ' color: '.$heading_color.'; ';
    }
    if($heading_font_style == 'italic'){
        $heading_styles .= ' font-style: '.$heading_font_style.'; ';
    }    
    
    $desc_styles = '';
    if($desc_font != ''){
        $output .= '<style>@import url(https://fonts.googleapis.com/css?family='.$desc_font.');</style>';
    }
    if($desc_font != ''){
        $desc_font = str_replace('+', ' ', $desc_font);
        $desc_styles .= ' font-family: '.$desc_font.'; ';
    }
    if(!empty($desc_f_size)){
        $desc_styles .= ' font-size: '.$desc_f_size.'px; ';
    }    
    if(!empty($desc_color)){
        $desc_styles .= ' color: '.$desc_color.'; ';
    }
    if($desc_font_style == 'italic'){
        $desc_styles .= ' font-style: '.$desc_font_style.'; ';
    }
    
    $shape1 = ATVC_PLUGIN_URL . 'assets/img/08.png';
    $shape2 = ATVC_PLUGIN_URL . 'assets/img/09.png';
    
    $testimonials = vc_param_group_parse_atts($testimonials);
    $testimonial_carousel_html ='';
    if ($testimonials !== ''){
        foreach ($testimonials as $testimonial) {
            $image = wp_get_attachment_image_src( $testimonial['image'], 'full' );
            $testimonial_carousel_html .= '<div class="single-testimonial-item">
                        <img src="'.$image[0].'" alt="">
                        <div class="hover">
                            <div class="hover-inner">
                                <div class="icon"><i class="fa fa-quote-left"></i></div>
                                <p style="'.$desc_styles.'">'.$testimonial['text'].'</p>
                                <div class="author-meta">
                                    <h4 style="'.$heading_styles.'" class="name">'.$testimonial['name'].'</h4>
                                    <span class="post">'.$testimonial['desig'].'</span>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    }
    
    
    $output .= '<div class="testimonial-area '.$el_class.'">';
    
    $output .= '<div class="shape-1"><img src="'.$shape1.'" alt=""></div>
                <div class="shape-2"><img src="'.$shape2.'" alt=""></div>';
    
    $output .= '<div class="testimonial-carousel">'.$testimonial_carousel_html.'</div>';
    
    $output .= '</div>';
    
    return $output;
}

add_shortcode("atvc_testimonial", "atvc_testimonial_shortcode");