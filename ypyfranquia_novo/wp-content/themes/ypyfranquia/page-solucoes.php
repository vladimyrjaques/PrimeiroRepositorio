<?php  get_header(); ?>

<?php
$args = array(
    'post_type' => 'solucoes',
    'posts_per_page' => 2,
    'tax_query' => array(
        array(
            'taxonomy' => 'exibicao_solucoes',
            'field' => 'slug',
            'terms' => array('solucoes', 'ambos')
        )
    )
);

$query_solucoes = new WP_Query($args);
?>


<section id="section1-solucoes" style="background-color: #e8e6e6;">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mt-5 p-5" id="col-1">
               <h4> Crédito Consignado para Aposentados <br> e pensionistas do INSS </h4>
                <p>Assim é o Crédito consignado para <br> aposentados e pensionistas do INSS. A forma <br> mais simples de realizar sonhos, colocar as
                    <br> contas em dia e garantir a tranquilidade <br> e a comodidade que você merece. </p>

                <h4>Crédito Consignado para Servidores públicos <br> federais, estaduais e municipas </h4>
                <p>Rápido e sem complicações: o valor é <br> analisado, aprovado e o dinheiro é depositado na sua conta. O pagamento é feito em
                    <br> parcelas fixas que são descontadas diretamente do seu salário.</p>

                <a href="/financiamento/" id="botao-hover1">
                    <div class="botao-imgs3 botao-hover1"></div>
                </a>

            </div>

            <div class="col-lg-6 col-sm-12 mt-5" style="height: 30rem;" id="col-2">
                <div id="outdor_solucoes"></div>
            </div>

        </div>
    </div>

</section>


<section id="section2-solucoes" class="mt-5">
    <div class="container">
        <h4 style="color: #2b55a2; text-transform: uppercase;">Documentos Necessários <br> para realizar um empréstimo </h4>

        <div class="row text-center mt-3 mb-5">
            <div class="col-lg-5">

                <img class="img-fluid img-solucoes" src="<?php echo URL?>/assets/img/cpf.png" alt=""> <br>
                <p>CPF</p>

                <img class="img-fluid img-solucoes" src="<?php echo URL?>/assets/img/extrato.png" alt="">
                <p>Extrato do seu salário, holerite, <br> pagamento de pensão ou de <br> beneficio do INSS.</p>

            </div>

            <div id="border"></div>

            <div class="col-lg-5">

                <img class="img-fluid img-solucoes" src="<?php echo URL?>/assets/img/comprovante.png" alt=""> <br>
                <p>Comprovante de endereço <br> (conta de luz, água ou telefone nominal ao cliente)</p>

                <img class="img-fluid img-solucoes" src="<?php echo URL?>/assets/img/rg.png" alt="">
                <p>RG</p>

            </div>

        </div>

    </div>
</section>


<section id="section3-solucao">
    <div class="container text-desc">
        <p> A YPY realiza a intermediação, entre cliente e banco, de propostas de empréstimos <br> consignados com desconto em folha de pagamento. O serviço é personalizado e prestado
            <br> a aposentados e pensionistas do INSS, servidores públicos deferais, estaduais e municipais. </p>

        <br>

        <p>A atividade de correspondente bancário compreende a recepção e encaminhamento das propostas e é atualmente autorizada e regulamentada pela Lei 4.595/64 e pela Resolução
            <br> 3.954/2011 do Banco Central do Brasil. </p>
    </div>
</section>


<section id="section4-solucao" class="mt-5">
        <div id="titulto-destaque">
            <div class="container">
                <h3>Benefícios que a YPY oferece </h3>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <img class="img-fluid img-solucoes2" src="<?= URL ?>/assets/img/correto.png" alt=""> <span class="text-img"> Operações rápidas e sem burocracia </span>  <br>


                    <img class="img-fluid img-solucoes2" src="<?= URL ?>/assets/img/correto.png" alt=""> <span class="text-img"> Sem consulta ao spc serasa </span>  <br>


                </div>

                <div class="col-lg-6">
                    <img class="img-fluid img-solucoes2" src="<?= URL ?>/assets/img/correto.png" alt=""><span class="text-img">  Parcelas Fixas  </span> <br>


                    <img class="img-fluid img-solucoes2" src="<?= URL ?>/assets/img/correto.png" alt=""> <span class="text-img"> Não é ncessario avalista  </span> <br>


                </div>

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
            'terms' => 'quem-confia-na-ypy'
        ),
        array(
            'taxonomy' => 'exibicao',
            'field' => 'slug',
            'terms' => 'solucoes'
        )
    ),
));
?>

<section id="section-4" class="mt-4 mb-4">
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



<?php  get_footer(); ?>


