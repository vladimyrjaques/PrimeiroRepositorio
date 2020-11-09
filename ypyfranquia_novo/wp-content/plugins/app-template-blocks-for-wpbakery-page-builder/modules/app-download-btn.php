<?php
vc_map(array(
    "name" 			=> "App Download Button",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_download_btn",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array( 
        array(
            "type" => "textfield",
            "heading" => __("Button Text", 'tavc'),
            "param_name" => "title",
            'admin_label' => true,
            "description" => __("", 'tavc')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Url", 'tavc'),
            "param_name" => "url",
            "description" => __("", 'tavc')
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Button icon', 'js_composer' ),
            'param_name' => 'icon_fontawesome',
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
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Gradient Style', 'js_composer' ),
            'value' => array(
                __( 'style1', 'js_composer' ) => '1',
                __( 'style2', 'js_composer' ) => '2',
                __( 'style3', 'js_composer' ) => '3',
            ),
            'param_name' => 'gd_style',
            'description' => __( '', 'js_composer' ),
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
            "type" => "textfield",
            "heading" => esc_attr__("Extra class name", 'tavc'),
            "param_name" => "el_class",
            "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'tavc')
        ),        

    )
    
));

function atvc_download_btn_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'title' => '',
        'url' => '',
        'icon_fontawesome' => '',
        'gd_style' => '1',
        'heading_font' => '',
        'heading_f_size' => '',
        'heading_color' => '',
        'heading_font_style' => '',        
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
    
    
    
    // Load VC icons libraries
    vc_iconpicker_editor_jscss();
        
        
    $output .= '<div class="btn-wrapper '.$el_class.'">
                        <a style="'.$heading_styles.'" href="'.$url.'" class="boxed-btn btn-rounded gd-bg-'.$gd_style.'"><i class="'.$icon_fontawesome.'"></i> '.$title.'</a>
                    </div>';
    

    return $output;
}

add_shortcode("atvc_download_btn", "atvc_download_btn_shortcode");