<?php
vc_map(array(
    "name"             => "Info Box",
    "category"         => 'App Template',
    "description"       => "",
    "base"             => "atvc_info_box",
    "class"             => "",
    "icon"             => "atvc_icon",
    
    "params"     => array(
    
        array(
            "type" => "attach_image",
            "heading" => __("Middle Image", "tavc"),
            "param_name" => "image",
            "value" => "",
            "description" => __("Perfect image size is 687x808", "tavc")
        ),
    
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon1',
            'value' => 'fa fa-adjust',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 400,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                'type' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
            'group' => 'Box 1',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading", 'tavc'),
            "param_name" => "title1",
            "description" => __("", 'tavc'),
            'group' => 'Box 1',
        ),              
        array(
            "type" => "textarea",
            "heading" => __("Description", 'tavc'),
            "param_name" => "desc1",
            "description" => __("", 'tavc'),
            'group' => 'Box 1',
        ),
        
        
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon2',
            'value' => 'fa fa-adjust',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 400,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                'type' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
            'group' => 'Box 2',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading", 'tavc'),
            "param_name" => "title2",
            "description" => __("", 'tavc'),
            'group' => 'Box 2',
        ),              
        array(
            "type" => "textarea",
            "heading" => __("Description", 'tavc'),
            "param_name" => "desc2",
            "description" => __("", 'tavc'),
            'group' => 'Box 2',
        ),        
        
        
        
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon3',
            'value' => 'fa fa-adjust',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 400,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                'type' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
            'group' => 'Box 3',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading", 'tavc'),
            "param_name" => "title3",
            "description" => __("", 'tavc'),
            'group' => 'Box 3',
        ),              
        array(
            "type" => "textarea",
            "heading" => __("Description", 'tavc'),
            "param_name" => "desc3",
            "description" => __("", 'tavc'),
            'group' => 'Box 3',
        ),        
        
        
        
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon4',
            'value' => 'fa fa-adjust',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 400,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                'type' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
            'group' => 'Box 4',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading", 'tavc'),
            "param_name" => "title4",
            "description" => __("", 'tavc'),
            'group' => 'Box 4',
        ),              
        array(
            "type" => "textarea",
            "heading" => __("Description", 'tavc'),
            "param_name" => "desc4",
            "description" => __("", 'tavc'),
            'group' => 'Box 4',
        ),        
        
        
                
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Heading Font", "asvc"),
            "param_name" => "heading_font",
            "value" => atvc_google_font(),
            'group' => 'Styles',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading Font Size", 'tavc'),
            "param_name" => "heading_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Heading Font color", "asvc" ),
            "param_name"  => "heading_color",
            "description" => __( "Choose heading color", "asvc" ),
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Heading Font Style", "asvc"),
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
            'heading' => __('<h3 class="hvc_notice" align="center">Description Font Styles</h3>', 'hvc'),
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
            "heading" => __("Description Font Size", 'tavc'),
            "param_name" => "desc_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Description Font color", "asvc" ),
            "param_name"  => "desc_color",
            "description" => __( "Choose description color", "asvc" ),
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

function atvc_info_box_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'image' => '',
        
        'icon1' => '',
        'title1' => '',
        'desc1' => '',
        
        'icon2' => '',
        'title2' => '',
        'desc2' => '',
        
        'icon3' => '',
        'title3' => '',
        'desc3' => '',
        
        'icon4' => '',
        'title4' => '',
        'desc4' => '',
        
                                
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
   
    $image = wp_get_attachment_image_src( $image, 'full' );
    
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


    
    $output .= '<div class="row '.$el_class.'">
            <div class="col-lg-4 col-md-12">
                <div class="single-why-us-item margin-top-60 wow zoomIn"><!-- single why us item -->
                    <div class="icon gdbg-1">
                        <i class="'.$icon1.'"></i>
                    </div>
                    <div class="content">
                        <h4 style="'.$heading_styles.'" class="title">'.$title1.'</h4>
                        <p style="'.$desc_styles.'">'.$desc1.'</p>
                    </div>
                </div><!-- //. single why us item -->
                <div class="single-why-us-item wow zoomIn"><!-- single why us item -->
                    <div class="icon gdbg-2">
                        <i class="'.$icon2.'"></i>
                    </div>
                    <div class="content">
                        <h4 style="'.$heading_styles.'" class="title">'.$title2.'</h4>
                        <p style="'.$desc_styles.'">'.$desc2.'</p>
                    </div>
                </div><!-- //. single why us item -->
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="center-image">
                    <img src="'.$image[0].'" alt="">
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="single-why-us-item margin-top-60 wow zoomIn"><!-- single why us item -->
                    <div class="icon gdbg-3">
                        <i class="'.$icon3.'"></i>
                    </div>
                    <div class="content">
                        <h4 style="'.$heading_styles.'" class="title">'.$title3.'</h4>
                        <p style="'.$desc_styles.'">'.$desc3.'</p>
                    </div>
                </div><!-- //. single why us item -->
                <div class="single-why-us-item wow zoomIn"><!-- single why us item -->
                    <div class="icon gdbg-4">
                        <i class="'.$icon4.'"></i>
                    </div>
                    <div class="content">
                        <h4 style="'.$heading_styles.'" class="title">'.$title4.'</h4>
                        <p style="'.$desc_styles.'">'.$desc4.'</p>
                    </div>
                </div><!-- //. single why us item -->
            </div>
        </div>';
    

    return $output;
}

add_shortcode("atvc_info_box", "atvc_info_box_shortcode");