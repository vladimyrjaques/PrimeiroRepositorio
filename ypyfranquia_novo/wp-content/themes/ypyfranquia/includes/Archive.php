<?php


class Archive
{
    public function callArchives ()
    {
        wp_enqueue_style('bootstrap', get_template_directory_uri(). '/assets/css/bootstrap.css');
        wp_enqueue_style('header', get_template_directory_uri(). '/assets/css/estilos/estilo_header.css');
        wp_enqueue_style('media_query', get_template_directory_uri(). '/assets/css/estilos/media_querys.css');
        wp_enqueue_style('body', get_template_directory_uri(). '/assets/css/estilos/body.css');
        wp_enqueue_style('footer', get_template_directory_uri(). '/assets/css/estilos/footer.css');
        wp_enqueue_style('blog', get_template_directory_uri(). '/assets/css/estilos/blog.css');
        wp_enqueue_style('financiamento', get_template_directory_uri(). '/assets/css/estilos/financiamento.css');
        wp_enqueue_style('franqueado', get_template_directory_uri(). '/assets/css/estilos/franqueado.css');
        wp_enqueue_style('solucoes', get_template_directory_uri(). '/assets/css/estilos/solucoes.css');
        wp_enqueue_style('mapas', get_template_directory_uri(). '/assets/css/estilos/maps.css');
        wp_enqueue_style('single', get_template_directory_uri(). '/assets/css/estilos/single.css');
        wp_enqueue_style('comments', get_template_directory_uri(). '/assets/css/estilos/comments.css');

        wp_enqueue_script('javascript', get_template_directory_uri().'/assets/js/script.js');

        add_action('wp_enqueue_scripts', 'callArchives');
    }
}
