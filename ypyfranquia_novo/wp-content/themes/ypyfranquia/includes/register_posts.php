<?php


function register_post_depoimentos() {
    $labels = array(
        'name' => 'Depoimentos',
        'singular_name' => 'Depoimentos',
        'add_new' => 'Adicionar Depoimentos',
        'add_new_item' => 'Adicionar Depoimentos',
        'edit_item' => 'Editar Um Depoimento',
        'menu_name' => 'Depoimentos'
    );

    $array = array(
        'labels' => $labels,
        'description' => 'Cadastro de depoimentos',
        'public' => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-text-page',
        'supports' => array('title', 'editor', 'custom-field'),
    );

    register_post_type('depoimentos', $array);
}

register_taxonomy('tipo-depoimento', 'depoimentos'
    ,array(
        'label' => 'Tipo de Depoimento',
        'singular_label' => 'Tipo de Depoimentos',
        "rewrite" => true,
        "hierarchical" => true,
    )
);

register_taxonomy('exibicao', 'depoimentos'
    ,array(
        'label' => 'Local de Exibição',
        'singular_label' => 'Local de Exibição',
        "rewrite" => true,
        "hierarchical" => true,
    )
);


// ===============================================

function register_post_blog () {
    $labels = array(
        'name' => 'Blog',
        'singular_name' => 'Blog',
        'add_new' => 'Adicionar Blog',
        'add_new_item' => 'Adicionar Blog',
        'editr_item' => 'Editar Blog',
        'menu_name' => 'Blog'
    );

    $array = array(
        'labels' => $labels,
        'public' => true,
        'description' => 'Post para BLOGS',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'supports' => array('title', 'editor', 'custom-field', 'thumbnail', 'comments'),

    );

    register_post_type('blog', $array);
}


register_taxonomy('destaque','blog',
    array(
        'label' => 'Destaques',
        'singular_label' => 'Destaques',
        "rewrite" => true,
        "hierarchical" => true,
    )
);


//********************************************************

function register_post_solucoes () {
    $labels = array(
        'name' => 'Soluções',
        'singular_name' => 'Soluções',
        'edit_new_item' => 'Editar Soluções',
        'edit_item' => 'Editar Soluções',
        'menu_name' => 'Soluções',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'supports' => array('title', 'thumbnail', 'custom-field', 'editor'),
        'menu_icon' => 'dashicons-nametag',
    );

    register_post_type('solucoes', $args);
}

register_taxonomy('tipo_solucao', 'solucoes', array(
    'label' => 'Tipo De Solução',
    'singular_label' => 'Tipo de Solução',
    'rewrite' => true,
    'hierarchical' => true
));

register_taxonomy('exibicao_solucoes', 'solucoes', array(
    'label' => 'Exibição na Página',
    'singular_label' => 'Exibição na Página',
    'rewrite' => true,
    'hierarchical' => true
));