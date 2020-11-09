<?php
vc_map(array(
    "name"             => "Team Member",
    "category"         => 'App Template',
    "description"    => "",
    "base"             => "atvc_team_member",
    "class"         => "",
    "icon"             => "atvc_icon",
    
    "params"     => array(
        array(
            "type" => "attach_image",
            "heading" => __("Member Image", "tavc"),
            "param_name" => "image",
            "value" => "",
            "description" => __("", "tavc")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Member Name", 'tavc'),
            "param_name" => "name",
            "description" => __("", 'tavc')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Member Designation", 'tavc'),
            "param_name" => "designation",
            "description" => __("ex: Developer", 'tavc')
        ),        
        array(
            "type" => "textfield",
            "heading" => __("Facebbok URL", 'tavc'),
            "param_name" => "facebook",
            "description" => __("keep blank if you do not want", 'tavc'),
            "group"   => "Social Accounts"
        ),                                      
        array(
            "type" => "textfield",
            "heading" => __("Twitter URL", 'tavc'),
            "param_name" => "twitter",
            "description" => __("keep blank if you do not want", 'tavc'),
            "group"   => "Social Accounts"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pinterest URL", 'tavc'),
            "param_name" => "pinterest",
            "description" => __("keep blank if you do not want", 'tavc'),
            "group"   => "Social Accounts"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Instagram URL", 'tavc'),
            "param_name" => "instagram",
            "description" => __("keep blank if you do not want", 'tavc'),
            "group"   => "Social Accounts"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Linkedin URL", 'tavc'),
            "param_name" => "linkedin",
            "description" => __("keep blank if you do not want", 'tavc'),
            "group"   => "Social Accounts"
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
            'heading' => __('<h3 class="hvc_notice" align="center">Designation Font Styles</h3>', 'hvc'),
            "param_name" => "hvc_notice_param_1",
            "value" => '',
            "group"       => "Styles"
        ),                                 
        array(
            "type" => "dropdown",
            "holder" => "",
            "class" => "",
            "heading" => __("Designation Font", "asvc"),
            "param_name" => "desc_font",
            "value" => atvc_google_font(),
            'group' => 'Styles',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Designation Font Size", 'tavc'),
            "param_name" => "desc_f_size",
            "description" => __("Choose font size in pixel. ex: 30", 'tavc'),
            "group"       => "Styles"
        ),
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Designation Font color", "asvc" ),
            "param_name"  => "desc_color",
            "group"       => "Styles"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Designation Font Style", "asvc"),
            "param_name" => "desc_font_style",
            "value" => array(
                "None" => "",
                "Italic" => "italic",
            ),
            "group"       => "Styles"
        ),        
        array(
            "type"        => "colorpicker",
            "class"       => "",
            "heading"     => __( "Social Icons color", "asvc" ),
            "param_name"  => "icons_color",
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

function atvc_team_member_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    
        'image' => '',
        'name' => '',
        'designation' => '',
        'facebook' => '',
        'twitter' => '',
        'linkedin' => '',
        'instagram' => '',
        'pinterest' => '',
        'heading_font' => '',
        'heading_f_size' => '',
        'heading_color' => '',
        'heading_font_style' => '',
        'desc_font' => '',
        'desc_f_size' => '',
        'desc_color' => '',
        'desc_font_style' => '',               
        'icons_color' => '',        
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
    
    if (!empty($icons_color)){
        $output .= '<style>.social-icon li i {
                    color: '.$icons_color.';
                }</style>';
    }
    
    $social_links ='';
    if ( !empty( $facebook ) ) {
        $social_links .='<li><a href="'.$facebook.'"><i class="fa fa-facebook"></i></a></li>'; 
    }
    if ( !empty( $twitter ) ) {
        $social_links .='<li><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></li>';                
    }
    if ( !empty( $linkedin ) ) {
        $social_links .='<li><a href="'.$linkedin.'"><i class="fa fa-linkedin"></i></a></li>';                
    }    
    if ( !empty( $googleplus ) ) {
        $social_links .='<li><a href="'.$googleplus.'"><i class="fa fa-google-plus"></i></a></li>';                 
    }                
    if ( !empty( $instagram ) ) {
        $social_links .='<li><a href="'.$instagram.'"><i class="fa fa-instagram"></i></a></li>';               
    }
    if ( !empty( $pinterest ) ) {
        $social_links .='<li><a href="'.$pinterest.'"><i class="fa fa-pinterest-p"></i></a></li>';               
    }    
    
    
    // Load VC icons libraries
    vc_iconpicker_editor_jscss();
    
    $output .= '<div class="single-team-member '.$el_class.'">
                        <div class="thumb">
                            <img src="'.$image[0].'" alt="">
                            <div class="hover">
                                <ul class="social-icon">
                                    '.$social_links.'
                                </ul>
                            </div>
                        </div>
                        <div class="content">
                            <h4 style="'.$heading_styles.'" class="title">'.$name.'</h4>
                            <span style="'.$desc_styles.'" class="post">'.$designation.'</span>
                        </div>
                    </div>';
    

    return $output;
}

add_shortcode("atvc_team_member", "atvc_team_member_shortcode");