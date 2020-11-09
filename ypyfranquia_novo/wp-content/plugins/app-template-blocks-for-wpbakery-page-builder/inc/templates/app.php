<?php

/****************************************************************/
/************************ APP ******************************/
/****************************************************************/


add_action( 'vc_load_default_templates_action','atvc_template_for_vc' ); // Hook in
 
function atvc_template_for_vc() {
    $data               	= array(); 
    $data['name']       	= __( 'App Template', 'tavc' );
    $data['weight']     	= 0; 
    $data['image_path'] 	= plugins_url( 'assets/img/templates/e.png', __FILE__ );//Thumbnail should have this dimensions: 114x154px
    $data['custom_class'] 	= 'business_template_for_vc_custom_template';
    
    
    $data['content']    	= '
    
[vc_row][vc_column][vc_raw_html]JTNDaDMlMjBhbGlnbiUzRCUyMmNlbnRlciUyMiUzRVRoaXMlMjBpcyUyMG9ubHklMjBmb3IlMjBwcm8lMjB2ZXJzaW9uLiUyMFBsZWFzZSUyMHB1cmNoYXNlJTIwdGhlJTIwcHJvJTIwdmVyc2lvbiUyMGhlcmUlMjAlM0NiciUzRSUzQ2ElMjB0YXJnZXQlM0QlMjJfYmxhbmslMjIlMjBocmVmJTNEJTIyaHR0cHMlM0ElMkYlMkZjb2RlbnB5LmNvbSUyRml0ZW0lMkZhcHAtdGVtcGxhdGUtYmxvY2tzLWZvci13cGJha2VyeS1wYWdlLWJ1aWxkZXIlMkYlMjIlM0VBcHAlMjBUZW1wbGF0ZSUyMEJsb2NrcyUyMGZvciUyMFdQQmFrZXJ5JTIwUGFnZSUyMEJ1aWxkZXIlMjBQcm8lM0MlMkZhJTNFJTIwJTIwZm9yJTIwb25seSUyMCUyNDEzJTNDJTJGaDMlM0U=[/vc_raw_html][/vc_column][/vc_row]

';

  
    vc_add_default_templates( $data );
}