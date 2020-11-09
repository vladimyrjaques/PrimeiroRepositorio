<?php get_header(); ?>
<main class="wrap">
  <section class="content-area content-full-width">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="article-full">
        <header>
          <?php //the_title(); ?>
          <?php //the_author(); ?>
        </header>

          <div class="container">
              <?php the_content(); ?>
          </div>

      </article>


<?php endwhile; else : ?>
      <article>
        <p>Sorry, no post was found!</p>
      </article>
<?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>


<style>
    .wpcf7-form-control-wrap input {
        padding: 10px;
        border-radius: 0px;
        color: #333;
        background-color: rgba(255, 255, 255, 0);
        border: 1px solid #ccc;
    }

    .wpcf7-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        flex-wrap: wrap;
    }


    h2.vc_custom_heading {
        font-size: 24px;
        color: #1e1e1e;
        text-align: center;
        font-family: Lato;
        font-weight: 400;
        font-style: normal;
    }

    form.wpcf7-form {
        color: #333;
    }

    .wpcf7-form .column p {
        color: #333;
        margin-bottom: 1px;
    }

    .custom-field {
        margin: 35px 0px;
    }


    .wpb_wrapper i {
        margin-right: 9px;
    }

    .wpcf7-form-control.wpcf7-submit {
        width: ;
        position: relative;
        bottom: 22px;
        left: 8rem;
    }

    .column.one {
        width: 100%;
    }

    .column.one p {
        margin-left: 8.1rem;
    }

    textarea.wpcf7-form-control.wpcf7-textarea {
        transform: translateX(-50%);
        margin-left: 50%;
        width: 21vw;
        resize: none;
    }

    .wpcf7-form-control-wrap input {
        transform: translateX(-50%);
        margin-left: 50%;
        width: 21vw;
    }

    @media (max-width: 1600px) {
        textarea.wpcf7-form-control.wpcf7-textarea {
            transform: translateX(-50%);
            margin-left: 50%;
            width: 25.5rem;
            resize: none
        }
        .wpcf7-form-control-wrap input {

            transform: translateX(-50%);
            margin-left: 50%;
            width: 25.5rem;
        }
    }

    .wpb_column.vc_column_container.vc_col-sm-6 h2 {
        margin-left: 6rem;
        font-size: 17pt !important;
        margin-bottom: 2rem;
    }

</style>


<script>

    $('.endereco-field').prepend(`<i class="fas fa-map-marker-alt"></i>`)
    $('.tel-field').prepend(`<i class="fas fa-phone"></i>`)
    $('.email-field').prepend(`<i class="fas fa-envelope"></i>`)
    $('.wpcf7-form-control.wpcf7-submit').val('Enviar')
    $('.your-message .wpcf7-textarea').attr('cols', '41')


</script>


