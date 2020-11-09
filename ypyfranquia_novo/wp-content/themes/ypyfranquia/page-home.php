<?php get_header(); ?>

<!-- SECTION 1 -->


<section id="section-1">
    <div class="col-lg-12 rev-slide-position">
        <?php
        $shortecode = get_field('shortecode');
        echo do_shortcode($shortecode);
        ?>
    </div>

</section>

<!-- ============================ -->

<!-- SECTION 2 -->

<?php
    $args = array(
        'post_type' => 'solucoes',
        'posts_per_page' => -1,
        'tax_query' => array(
           array(
               'taxonomy' => 'exibicao_solucoes',
               'field' => 'slug',
               'terms' => array('home', 'ambos')
           )
        )
    );

    $query_solucoes = new WP_Query( $args );
?>



<section id="section-2">
    <div class="container mt-5 milagre">
        <div id="conteudo-section2">
            <h4>Conheça nossas Soluções</h4>
            <hr class="linha">
            <p> A YPY facilita sua vida e realiza a intermediação entre você e o  banco em propostas de empréstimos consignados com desconto em
                folha de pagamento. É simples e fácil, com tudo aprovado o dinheiro na sua conta. </p>
        </div>

        <div id="conteudo-imgs-section2">
            <div class="responsive">

                <?php if ($query_solucoes->have_posts()) : ?>
                <?php while ($query_solucoes->have_posts()) : ?>
                <?php $query_solucoes->the_post(); ?>
                <!--         --><?php //echo the_content(); ?>
                <div class="px-0 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 coluna-img">
                    <div class="content-solucoes">
                        <div class="texto-flutuante">
                            <p> <?php echo the_content(); ?> </p>
                        </div>
                        <div id="img-casal-new" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>)">
                    </div>
                </div>
            </div>

            <?php endwhile; ?>
            <?php endif; ?>

            </div>



            <div id="animation-pai" class="animate__animated animate__fadeIn animate__delay-2s">
                <div class="botao-animado animate__animated animate__rubberBand animate__delay-2s">
                    <a href="/financiamento/">
                        <div class="botao-img"></div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- =====================  -->

<!-- SECTION 3 -->
<section id="section-3">

    <div class="container">
                <div class="">
                  <h3 style=" padding-top: 1rem; color:#fff;font-size: 30pt; text-transform: uppercase;"> Com a YPY <br> Você pode ter... </h3>
                </div>
        <div class="row text-center p-5 text-white">


            <div class="col-lg-4 position-relative card-geral">

                <div class="content-card2">

                    <div> Temos a sução mais <br> simplles de realizar seus <br> sonhos. Com cuidado, <br> carinho e a garantia que voçe precisa </div>

                </div>

                <div class="content-card1">

                    <div>
                        <img width="100px" src="<?= URL ?>/assets/img/sonhos.png" alt="" class="img-fluid">
                        <h5 class="mt-2">SONHOS</h5>
                    </div>

                </div>

            </div>

            <!-- ================ COL-LG-2 =========== -->

            <div class="col-lg-4 position-relative card-geral">

                <div class="content-card2">

                    <div> Atvidade regulamentada <br> pelo Banco Central do Brasil. Seguranaça e <br> tranquilidade pra voçê e para sua família </div>

                </div>

                <div class="content-card1">

                    <div>
                        <img width="120px" src="<?= URL ?>/assets/img/tranquilidade.png" alt="" class="img-fluid">
                        <h5 class="mt-4">TRANQUILIDADE</h5>
                    </div>

                </div>

            </div>


            <!-- ================ COL-LG-3 =========== -->

            <div class=" col-lg-4  position-relative card-geral">

                <div class="content-card2">

                    <div> Contas em dia e <br> tranquilidade para sua <br> família. Pode contar com <br> a YPY para organizar <br> as finanças de um jeito </div>

                </div>

                <div class="content-card1">

                    <div>
                        <img width="100px" src="<?= URL ?>/assets/img/segurança.png" alt="" class="img-fluid">
                        <h5 class="mt-4">SEGURANÇA</h5>
                    </div>

                </div>

            </div>



        </div>
    </div>

</section>


<!-- ============================ -->

<!-- SECTION 4 -->

<?php
    $query = new WP_Query(array(
      'post_type' => 'depoimentos',
      'posts_per_page' => '3',
      'tax_query' => array(
        array(
            'taxonomy' => 'tipo-depoimento',
            'field' => 'slug',
            'terms' => 'quem-confia-na-ypy'
        ),
        array(
            'taxonomy' => 'exibicao',
            'field' => 'slug',
            'terms' => 'home'
        )
      ),
    ));
?>

<section id="section-4" class="mt-4">
    <div class="container">

        <div class="row p-5">
          <div class="mb-5">
            <h3 style="color:#bd3939;font-size: 30pt; text-transform: uppercase;"> Quem Confia <br> Na YPY</h3>
          </div>


            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="3000">

              <div class="text-center pb-4">
                  <img src="<?= URL?>/assets/img/aspas.png"  class="img-fluid" alt="">
              </div>

                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev"> <  </a>

                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next"> > </a>

                <div class="carousel-inner text-center">



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


                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                </a>
            </div>
        </div>

    </div>
</section>



<!-- ====================================== -->
<!-- SECTION 5 -->

<?php

  $query_blog = new WP_Query(array(
    'post_type' => 'blog',
    'posts_per_page' => '3',
    'tax_query' => array(
      array(
        'taxonomy' => 'destaque',
        'field' => 'slug',
        'terms' => 'destaque-home'
      )
    )
  ));


?>


<section id="section-5" class="mt-5 mb-5">
    <div class="container">

      <div class="mb-5">
        <h3 style="color:#00509e;font-size: 30pt; text-transform: uppercase;"> Últimos Posts <br> Do Blog </h3>
      </div>

        <div class="row">

            <?php if ($query_blog->have_posts()) : ?>
                <?php while($query_blog->have_posts()) : ?>

                  <?php $query_blog->the_post(); ?>

                    <div class="col-lg-4">

                  <?php if (has_post_thumbnail()) { ?>

                    <a target="_blank" href="<?= get_permalink()?>">

                    <div class="position-relative animate__animated animate__fadeIn animate__delay-1s">
                        <div class="img-blog"  style="background-image: url('<?= get_the_post_thumbnail_url();?>') ">
                            <div class="overlay"><p class="title-over"><?php the_title() ?></p></div>
                        </div>
                    </div>

                    <div class="conteudo-blog">
                        <h4> <?= get_the_title(); ?> </h4>
                        <p>
                          <?php
                            $content = get_the_excerpt();
                            $str = substr($content, 0, 100);
                            echo "$str";
                          ?>
                         </p>
                    </div>

                  </a>

                  <?php } ?>

                </div>
                <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
