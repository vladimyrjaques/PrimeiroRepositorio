<?php get_header(); ?>
    <main class="wrap">
        <section class="content-area content-thin">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="article-full">
                    <header id="title-mapa">
                        <h2><?php the_title(); ?></h2>
                    </header>
                    <?php the_content(); ?>
                </article>
            <?php endwhile; else : ?>
                <article>
                    <p>Sorry, no page was found!</p>
                </article>
            <?php endif; ?>
        </section>
        <?php //get_sidebar(); ?>
    </main>
<?php get_footer(); ?>


<style>
    #title-mapa {
        display: flex;
        justify-content: center;
        padding: 2.5rem 0px;
    }

    #title-mapa h2 {
        color: #07519B;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 29pt;
    }
</style>
