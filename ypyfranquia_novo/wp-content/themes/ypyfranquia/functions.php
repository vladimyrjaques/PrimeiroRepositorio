<?php


require_once ('includes/setup.php');

require_once('class-wp-bootstrap-navwalker.php');

function myplugin_ajaxurl () {
    echo '<script type="text/javascript"> var ajaxurl = "' . admin_url('admin-ajax.php') . ' "; </script>';
}

add_action('wp_head', 'myplugin_ajaxurl');


function wordpress_pagination($query) {
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    $pagination = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $query->max_num_pages,
        'prev_text' => '',
        'next_text' => ''
    ) );


    echo $pagination;
}



function changeFormulario () {

    $value = $_POST['value'];
    $value = strtolower($value);


   $args = array(
       'post_type' => 'solucoes',
       'tax_query' => array(
          array(
             'taxonomy' => 'tipo_solucao',
             'field' => 'slug',
             'terms' => $value
          )
       )
   );

   $query = new WP_Query($args);

    if ($query->have_posts()) {
        while($query->have_posts()) {
              $query->the_post();
              $field = do_shortcode(get_field('shortcode'));
        }
    }
    if($value == "padrao"){
        $field = "";
    }
    wp_send_json($field);

}


add_action('wp_ajax_changeFormulario', 'changeFormulario', 10);
add_action('wp_ajax_nopriv_changeFormulario', 'changeFormulario', 10);


