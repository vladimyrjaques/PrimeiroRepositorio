<?php
vc_map(array(
    "name" 			=> "Feature Box",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_feature",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array(
        
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon library', 'js_composer' ),
            'value' => array(
                __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                __( 'Typicons', 'js_composer' ) => 'typicons',
                __( 'Entypo', 'js_composer' ) => 'entypo',
                __( 'Linecons', 'js_composer' ) => 'linecons',
                __( 'Mono Social', 'js_composer' ) => 'monosocial',
                __( 'Material', 'js_composer' ) => 'material',
            ),
            'admin_label' => true,
            'param_name' => 'icon_type',
            'description' => __( 'Select icon library.', 'js_composer' ),
            "std"		=> "fontawesome",
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                'type' => 'fontawesome',
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_pe7stroke',
            'value' => 'pe-7s-album',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                'type' => 'pe7stroke',
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'pe7stroke',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'openiconic',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'typicons',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'entypo',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'linecons',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_monosocial',
            'value' => 'vc-mono vc-mono-fivehundredpx',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'monosocial',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'monosocial',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_material',
            'value' => 'vc-material vc-material-cake',
            // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'material',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'material',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Background Style', 'js_composer' ),
            'value' => array(
                __( '1', 'js_composer' ) => '1',
                __( '2', 'js_composer' ) => '2',
                __( '3', 'js_composer' ) => '3',
                __( '4', 'js_composer' ) => '4',
            ),
            'param_name' => 'icon_bg_style',
            'description' => __( '', 'js_composer' ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'tavc'),
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
            'type' => 'dropdown',
            'heading' => __( 'Add Link', 'js_composer' ),
            'value' => array(
                __( 'Yes', 'js_composer' ) => 'yes',
                __( 'No', 'js_composer' ) => 'no',
            ),
            'param_name' => 'add_link',
            'description' => __( '', 'js_composer' ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link Url", 'tavc'),
            "param_name" => "url",
            "description" => __("", 'tavc'),
            'dependency' => array(
                'element' => 'add_link',
                'value' => 'yes',
            ),
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

function atvc_features_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => '',
        'icon_pe7stroke' => '',
        'icon_openiconic' => '',
        'icon_typicons' => '',
        'icon_entypo' => '',
        'icon_linecons' => '',
        'icon_monosocial' => '',
        'icon_material' => '',        
        'icon' => '',
        'icon_bg_style' => '1',
        'title' => '',
        'desc' => '',
        'url' => '',
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
    
    $icon_bg1 = ATVC_PLUGIN_URL . 'assets/img/11.png';
    $icon_bg2 = ATVC_PLUGIN_URL . 'assets/img/12.png';
    $icon_bg3 = ATVC_PLUGIN_URL . 'assets/img/13.png';
    $icon_bg4 = ATVC_PLUGIN_URL . 'assets/img/14.png';
    
    
    $output .= '<style> .feature-list .single-feature-list .icon.icon-bg-1 {
                    background-image: url('.$icon_bg1.');
                }
                 .feature-list .single-feature-list .icon.icon-bg-2 {
                    background-image: url('.$icon_bg2.');
                }
                 .feature-list .single-feature-list .icon.icon-bg-3 {
                    background-image: url('.$icon_bg3.');
                }
                 .feature-list .single-feature-list .icon.icon-bg-4 {
                     background-image: url('.$icon_bg4.');
                }</style>';
    
    // Icon
    if($icon_type) {

        // Load VC icons libraries
        vc_iconpicker_editor_jscss();

        switch($icon_type) {
            case 'fontawesome':
                $icon_html = '<i class="'.$icon_fontawesome.'"></i>';
            break;
            case 'openiconic':
                $icon_html = '<i class="'.$icon_openiconic.'"></i>';
            break;
            case 'typicons':
                $icon_html = '<i class="'.$icon_typicons.'"></i>';
            break;
            case 'entypo':
                $icon_html = '<i class="'.$icon_entypo.'"></i>';
            break;
            case 'linecons':
                $icon_html = '<i class="'.$icon_linecons.'"></i>';
            break;
            case 'monosocial':
                $icon_html = '<i class="'.$icon_monosocial.'"></i>';
            break;
            case 'material':
                $icon_html = '<i class="'.$icon_material.'"></i>';
            break;
            case 'pe7stroke':
                $icon_html = '<i class="'.$icon_pe7stroke.'"></i>';
            break;
        }

    } else {
        $icon_html = '';
    }
    
    if(isset( $url )){
        $link_html = '<h4 style="'.$heading_styles.'" class="title"><a href="'.$url.'">'.$title.'</a></h4>';
    }else{
        $link_html = '<h4 style="'.$heading_styles.'" class="title">'.$title.'</h4>';
    }
    $output .= '<div class="feature-area '.$el_class.'">
                    <ul class="feature-list">
                        <li class="single-feature-list">
                            <div class="icon icon-bg-'.$icon_bg_style.'">
                                '.wp_kses_post($icon_html).'
                            </div>
                            <div class="content">
                                '.$link_html.'
                                <p style="'.$desc_styles.'">'.$desc.'</p>
                            </div>
                        </li>
                    </ul>
                </div>';
    

    return $output;
}

add_shortcode("atvc_feature", "atvc_features_shortcode");