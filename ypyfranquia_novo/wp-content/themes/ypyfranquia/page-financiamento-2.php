<?php get_header();  ?>

<?php
        $args = array(
'post_type' => 'solucoes',
'posts_per_page' => -1
);

$query = new WP_Query( $args );

?>
<!-- Vladimyr -->
<div class="fundo">
    <div class="back-ground"></div>
    <div class="container">
        <div class="row shadow">
            <div class="col-md-12 relative_box">
            <div class="target init" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/dualring2.gif')"></div>
                <h3 class="title2"> Solicite uma Simulação </h3>
                <p>Entraremos em contato com você com as melhores ofertas para a sua necesidade </p>
                <div class="col-md-6" id="select">
                    <select autofocus name="option" class="form-control" id="option_solucao" onchange="changeForm()">
                        <option value="padrao" selected>Selecione uma solução</option>
                        <?php if ($query->have_posts()) : ?>
                            <?php while($query->have_posts()) :?>
                                <?php  $query->the_post(); ?>
                                <?php $opt = get_field('tipo_solucao'); ?>
                                <option value="<?= $opt?>"> <?= $opt?> </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div id="form-shortcode">
                    <!--
                    <?=  do_shortcode('[contact-form-7 id="68" title="Formulário de contato 1"]'); ?>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const changeForm = () => {
        
        $('.target').removeClass("init");
        $('.target').removeClass("end-load");
        $('.target').addClass("load");
        
        const val = $('#option_solucao').val()
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'changeFormulario',
                value: val,
            }
        }).done(date => {
            // console.log(date)
            $('#form-shortcode').empty()
            $('#form-shortcode').append(date)
            
            setTimeout(function(){ 
                $('.target').addClass("end-load");
                $('.target').removeClass("load");
             }, 1000);
            
            
            
        })
    }

</script>
<!-- Fim Vladimyr -->
<?php get_footer();  ?>
