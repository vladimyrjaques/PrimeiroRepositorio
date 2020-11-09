<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 offset-md-1">
            <?php if(have_posts()) : ?>
                <?php while(have_posts()): ?>
                    <?php the_post(); ?>
                    <h4  class="titulo-single"> <?= get_the_title(); ?>  </h4>
                    <div class="conteudo-single">
                        
                        <div class="legend">
                        <p> <strong>Por: </strong> <?= get_the_author()?> - <?= get_the_date('d/m/Y'); ?> </p>
                    </div>

                    <div id="share-post">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink(); ?>"> <i class="face fab fa-facebook-f"></i> </a>
                        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= get_permalink()?>"> <i class="linkedin fab fa-linkedin-in"></i> </a>
                        <a target="_blank" href="https://web.whatsapp.com/send?text=<?= get_permalink(); ?>"> <i class="whats fab fa-whatsapp"></i> </a>
                    </div>

                        <?php the_content(); ?>
                    </div>

                <?php endwhile;?>
            <?php endif;?>
            
        </div>
    </div>
</div>



<hr>

<section class="mt-5 mb-5">


    <div class="container">

        <?php if (have_posts()) : ?>
            <?php while(have_posts()): ?>
                <?php the_post();?>
                <?php
                if (comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>

            <?php endwhile;?>
        <?php endif;?>

    </div>

</section>

<hr>


<!--LOOP 2-->
<section id="section2-single" class="mt-5">

    <?php
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => 3
    );

    $query_blog = new WP_Query( $args );

    ?>

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

                            <a href="<?= get_permalink()?>">

                                <div class="position-relative animate__animated animate__fadeIn animate__delay-1s">
                                    <div class="img-blog"  style="background-image: url('<?= get_the_post_thumbnail_url();?>') "></div>
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

            <div id="btn_all_blogs">
                <a href="/blog" target="_blank" id="all_btn_blogs" class="btn"> Ver todas as noticias </a>
            </div>

        </div>
    </div>

</section>

<?php  get_footer(); ?>
