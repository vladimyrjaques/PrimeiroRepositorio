<?php get_header(); ?>

<?php

  $query_destaque = new WP_Query(array(
    'post_type' => 'blog',
    'posts_per_page' => '1',
      'tax_query' => array(
          array(
              'taxonomy' => 'destaque',
              'field' => 'slug',
              'terms' => 'destaque-blog'
          )
      )
  ));

?>


<section id="section-blog1">
    <div class="container">
        <div class="row ">

            <div class="col-lg-8 mt-5 mb-5 animate__animated animate__fadeInLeft delay-0_5">

                <?php if ($query_destaque->have_posts()) : ?>

                <?php while ($query_destaque->have_posts()): ?>

                <?php $query_destaque->the_post(); ?>

                <a href="<?= get_permalink()?>" target="_blank">

                <div class="position-relative" style="height: 20rem;max-width: 35rem;">
                    <div id="img-blog-destaque"
                         style="background-image: url('<?= get_the_post_thumbnail_url() ?>') "></div>
                </div>
                </a>

            </div>


            <div class="col-lg-4 mt-5 mb-5  animate__animated animate__fadeInRight delay-0_5 ">
                <div id="conteudo-blog-destaque">
                    <h4><strong> <?= get_the_title() ?>  </strong></h4>

                    <p>
                        <?php
                           $content_blog =  get_the_excerpt();
                           $str_blog = substr($content_blog, 0, 225);
                           echo $str_blog;
                        ?>
                    </p>

                    <button class="btn-blog">Saiba Mais <img class="flecha" src="<?= URL?>/assets/img/arrow.png" alt="">  </button> 
                </div>
            </div>
            <?php endwhile; ?>

            <?php endif; ?>


        </div>
    </div>
</section>



<section id="section-blog2" class="mt-5 mb-5">

    <?php

    $query_blog = new WP_Query(array(
        'post_type' => 'blog',
        'posts_per_page' => '6',
    ));

    ?>

    <div class="container">
        <div class="row2" id="link-scroll">

            <?php if ($query_blog->have_posts()) :?>

                <?php while ($query_blog->have_posts()) :?>

                    <?php $query_blog->the_post(); ?>


                        <div class="col-lg-6 mt-5 mb-2">

                            <a href="<?= get_permalink(); ?>" target="_blank">

                                <div class="position-relative animate__animated animate__fadeIn animate__delay-1s">
                                    <div class="img-blog"  style="background-image: url('<?= get_the_post_thumbnail_url();?>') ">
                                        <div class="overlay"><p class="title-over"><?php the_title() ?></p></div>
                                    </div>
                                </div>

                            <div class="blog-conteudo">
                                <h4> <strong> <?= get_the_title()?> </strong>  </h4>
                                <p> <?php
                                    $content = get_the_excerpt();
                                    $str = substr($content, 0, 120);
                                    echo $str;
                                    ?>
                                </p>
                            </div>

                        </div>
                    </a>

                <?php endwhile;?>

            <?php endif; ?>

        </div>
    </div>

    <div class="paginacao">
        <?php wordpress_pagination($query_blog); ?>
    </div>

</section>


<script>
    $(document).ready(function () {
        const url = window.location.pathname;
        if (url.match('page/')) {
            window.location.href = '#link-scroll';
        }
    });

</script>


<?php get_footer(); ?>
