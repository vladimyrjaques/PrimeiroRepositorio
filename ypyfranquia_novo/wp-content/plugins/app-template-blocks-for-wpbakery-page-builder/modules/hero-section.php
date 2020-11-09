<?php
vc_map(array(
    "name"             => "Hero Section",
    "category"         => 'App Template',
    "description"       => "",
    "base"             => "atvc_hero_section",
    "class"             => "",
    "icon"             => "atvc_icon",
    
    "params"     => array(
        array(
            "type" => "attach_image",
            "heading" => __("Mobile Image", "tavc"),
            "param_name" => "image",
            "admin_label" => true,
            "value" => "",
            "description" => __("Perfect image size is 687x808", "tavc")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading", 'tavc'),
            "param_name" => "title",
            "description" => __("", 'tavc')
        ),              
        array(
            "type" => "textarea",
            "heading" => __("Description", 'tavc'),
            "param_name" => "desc",
            "description" => __("", 'tavc')
        ),        
        array(
            "type" => "textfield",
            "heading" => __("Button 1 Text", 'tavc'),
            "param_name" => "btn1_text",
            "description" => __("", 'tavc')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button 1 URL", 'tavc'),
            "param_name" => "btn1_url",
            "description" => __("", 'tavc')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button 2 Text", 'tavc'),
            "param_name" => "btn2_text",
            "description" => __("", 'tavc')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button 2 URL", 'tavc'),
            "param_name" => "btn2_url",
            "description" => __("", 'tavc')
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

function atvc_hero_image_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'image' => '',
        'title' => '',
        'desc' => '',
        'btn1_text' => '',
        'btn2_text' => '',
        'btn1_url' => '',
        'btn2_url' => '',
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

    //$image_url = wp_get_attachment_url( $image, 'full' );
    //$image = aq_resize( $image_url, 296, 289, false ); //resize & crop the image
    //var_dump($image);    
    $image = wp_get_attachment_image_src( $image, 'full' );
    $image_bg = ATVC_PLUGIN_URL . 'assets/img/header-bg.png';
    $shape1 = ATVC_PLUGIN_URL . 'assets/img/01.png';
    $shape2 = ATVC_PLUGIN_URL . 'assets/img/02.png';
    $shape3 = ATVC_PLUGIN_URL . 'assets/img/03.png';
    
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

    
    $btn1_html = '';
    if (!empty($btn1_text)){
        $btn1_html = '<a href="'.$btn1_url.'" class="boxed-btn btn-rounded">'.$btn1_text.'</a>';
    }
    
    $btn2_html = '';
    if (!empty($btn2_text)){
        $btn2_html = '<a href="'.$btn2_url.'" class="boxed-btn btn-rounded">'.$btn2_text.'</a>';
    }
    
    $output .= '<style>.header-area.header-bg {
                background-image: url('.$image_bg.');
            }</style>';
    
    $output .= '<header class="header-area header-bg '.$el_class.'" id="home">
                    <div class="shape-1"><img src="'.$shape1.'" alt=""></div>
                    <div class="shape-2"><img src="'.$shape2.'" alt=""></div>
                    <div class="shape-3"><img src="'.$shape3.'" alt=""></div>
                <div class="header-right-image wow zoomIn">
                    <img src="'.$image[0].'" alt="'.$title.'">
                </div>
                    <div class="row">
                        <div class="col-lg-7 col-lg-offset-1">
                            <div class="header-inner">
                                <h1 style="'.$heading_styles.'" class="title wow fadeInDown">'.$title.'</h1>
                                <p style="'.$desc_styles.'">'.$desc.'</p>
                                <div class="btn-wrapper wow fadeInUp">
                                    '.$btn1_html.'
                                    '.$btn2_html.'
                                </div>
                            </div>
                        </div>
                    </div>
            </header>';
    

    return $output;
}

add_shortcode("atvc_hero_section", "atvc_hero_image_shortcode");