<?php
vc_map(array(
    "name" 			=> "Counter",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_counter",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Value", 'tavc'),
            "param_name" => "value",
            "description" => __("Ex: 1250", 'tavc')
        ), 
        array(
            "type" => "textfield",
            "heading" => __("Title", 'tavc'),
            "param_name" => "title",
            "description" => __("", 'tavc')
        ),        
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Counter icon', 'js_composer' ),
            'param_name' => 'icon',
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
            "type" => "textfield",
            "heading" => __("Icon Size", 'tavc'),
            "param_name" => "icon_size",
            "description" => __("Choose icon size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'tavc'),
            "param_name" => "icon_color",
            "description" => __("", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Value Font", "asvc"),
            "param_name" => "heading_font",
            "value" => atvc_google_font(),
            'group' => 'Styles',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Value Font Size", 'tavc'),
            "param_name" => "heading_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Value Font color", "asvc" ),
            "param_name"  => "heading_color",
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Value Font Style", "asvc"),
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
            'heading' => __('<h3 class="hvc_notice" align="center">Title Font Styles</h3>', 'hvc'),
            "param_name" => "hvc_notice_param_1",
            "value" => '',
            "group"       => "Styles"
        ),                                 
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Title Font", "asvc"),
            "param_name" => "desc_font",
            "value" => atvc_google_font(),
            'group' => 'Styles',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title Font Size", 'tavc'),
            "param_name" => "desc_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Title Font color", "asvc" ),
            "param_name"  => "desc_color",
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Style", "asvc"),
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

function atvc_counter_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'title' => '',
        'value' => '',
        'icon' => '',
        'icon_size' => '',
        'icon_color' => '',
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


    
    // Load VC icons libraries
    vc_iconpicker_editor_jscss();
            
    $output .= '<div class="single-counter-item '.$el_class.'">
                    <div class="icon">
                        <i style="font-size:'.$icon_size.'; color:'.$icon_color.'" class="'.$icon.'"></i>
                    </div>
                    <div class="content">
                        <span style="'.$heading_styles.'" class="count-num">'.$value.'</span>
                        <h4 style="'.$desc_styles.'" class="title">'.$title.'</h4>
                    </div>
                </div>';
    

    return $output;
}

add_shortcode("atvc_counter", "atvc_counter_shortcode");