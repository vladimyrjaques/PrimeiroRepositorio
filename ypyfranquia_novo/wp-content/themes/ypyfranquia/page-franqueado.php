<?php get_header(); ?>


<section id="section1-franqueado">
    <div class="container-fluid">
        <div class="position-relative animate__animated animate__fadeInLeft delay-0_5" style="height:35rem;">
            <div id="outdor1"></div>
        </div>
    </div>


    <div class="conteudo-franqueado animate__animated animate__fadeInRight delay-0_5">

        <h2 class="title-franqueado">Seja um <br> <span style="color: #a93644;">franqueado</span> </h2>
        <p> O conceito inovador da marca YPY disponibiliza <br> para o mercado o sistema de franquia. Queremos <br> oferecer a um grande número de pessoas e
            <br>empresas,  por meio da expansão da Rede através <br>  do Sistema de Franchising, a oportunidade de <br> ingressar em um negócio de sucesso ja testado e aprovado.</p>
    
        <div id="botao-franqueado">
            <div id="btn-azul" style="background-image: url('<?= URL?>/assets/img/botao-azul.png') "></div>
        </div>
    </div>

</section>

    <?php
    $query = new WP_Query(array(
        'post_type' => 'depoimentos',
        'posts_per_page' => '10',
        'tax_query' => array(
            array(
                'taxonomy' => 'tipo-depoimento',
                'field' => 'slug',
                'terms' => 'o-que-dizem-os-franqueados'
            ),
            array(
                'taxonomy' => 'exibicao',
                'field' => 'slug',
                'terms' => 'seja-um-franqueado'
            )
        ),
    ));
    ?>


    <section id="section2-franqueado" class="mt-5 mb-5">
        <div class="container">

            <div class="row p-5">
                <div class="mb-5">
                    <h3 style="color:#bd3939;font-size: 30pt; text-transform: uppercase;"> O que dizem <br> os franqueados </h3>
                </div>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="text-center pb-4">
                        <img src="<?= URL?>/assets/img/aspas.png"  class="img-fluid" alt="">
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <  </a>

                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> > </a>

                    <div class="carousel-inner">

                        <?php if ($query->have_posts()) { ?>
                            <?php while($query->have_posts()) { ?>
                                <?php $query->the_post(); ?>

                                <div class="carousel-item">
                                    <p> <?php echo get_the_content(); ?> </p>
                                    <p class="text-center text-danger"> <?= get_field('autor')?> - <?= get_field('local');?>  </p>
                                </div>


                            <?php } ?>
                        <?php } ?>

                    </div>
            </div>

        </div>
    </section>
</section>






<?php get_footer(); ?>
