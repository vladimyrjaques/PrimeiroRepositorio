<?php
vc_map(array(
    "name" 			=> "Pricing Table",
    "category" 		=> 'App Template',
    "description"	=> "",
    "base" 			=> "atvc_pricing_table",
    "class" 		=> "",
    "icon" 			=> "atvc_icon",
    
    "params" 	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Package Name", 'tavc'),
            "param_name" => "package_name",
            "value" => "Basic Plan",
            "description" => __("", 'tavc')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Price", 'tavc'),
            "param_name" => "price",
            "description" => __("", 'tavc')
        ),        
        array(
            "type" => "textfield",
            "heading" => __("Package Duration", 'tavc'),
            "param_name" => "package_duration",
            "value" => "Month",
            "description" => __("", 'tavc')
        ),                                 
        array(
            'type' => 'param_group',
            'heading' => __( 'Package Features', 'js_composer' ),
            'param_name' => 'features',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Feature Name', 'js_composer' ),
                    'param_name' => 'feature_name',
                    'description' => __( '', 'js_composer' ),
                    'value' => '',
                ),
            ),
        ),
                     
        array(
            "type" => "vc_link",
            "class" => "",
            "heading" => __("Button Text and Link", "asvc"),
            "param_name" => "button",
            "value" => "",
            "description" => __("Add a custom link or select existing page. You can remove existing link as well.", "asvc"),
        ),
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Pricing Title Font", "asvc"),
            "param_name" => "heading_font",
            "value" => atvc_google_font(),
            //"std" => 'Advent+Pro',
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
            "heading"     => __( "Title Font color", "asvc" ),
            "param_name"  => "heading_color",
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Style", "asvc"),
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
            'heading' => __('<h3 class="hvc_notice" align="center">Pricing List Font Styles</h3>', 'hvc'),
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

function atvc_pricing_table_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'package_name' => 'Basic Plan',
        'package_duration' => 'Per Month',
        'price' => '',
        'features' => '',
        'button' => '',
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
    
    $button = vc_build_link( $button );
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
    
              
    $btn_html ='';
    if($button['title'] !== '') {
        $btn_html .= '<a class="boxed-btn btn-rounded gd-bg-2" href="'.$button['url'].'" target="'.$button['target'].'">'.$button['title'].'</a>';
    }
    $features = vc_param_group_parse_atts($features);
    $features_html ='';
    if ($features !== ''){
        $features_html .= '<ul>';
        foreach ($features as $feature) {
            $features_html .= '<li style="'.$desc_styles.'">'.$feature['feature_name'].'</li>';
        }
        $features_html .='</ul>';
    }
    
    
    $output .= '<div class="single-price-plan-01 '.$el_class.'">
                   <div class="price-header">
                        <h4 class="name">'.$package_name.'</h4>
                        <div class="price-wrap">
                            <span class="price">'.$price.'</span>
                            <span class="month">/'.$package_duration.'</span>
                        </div>
                   </div>
                   <div class="price-body">
                       '.$features_html.'
                   </div>
                   <div class="price-footer">
                       '.$btn_html.'
                   </div>
                </div>';
    

    return $output;
}

add_shortcode("atvc_pricing_table", "atvc_pricing_table_shortcode");