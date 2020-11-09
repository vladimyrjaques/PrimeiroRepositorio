<?php get_header(); ?>
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" data-auto-replace-svg="nest"></script>

  <div class="container">
    <div id="img-mapa">
        <img src="<?php echo URL?>/maps/bahia/bahia.png" usemap="#image-map">
        <map name="image-map">
            <area target="" alt="Estado 01" title="Estado 01" onclick="change_pin('estado01')" href="#!" coords="361,393,407,470" shape="rect" id="main">
            <area target="" alt="Estado 02" title="Estado 02" onclick="change_pin('estado02')" href="#!" coords="519,250,562,328" shape="rect">
        </map>
    </div>
  </div>

    <div id="info">
    </div>



<section class="maps">
    <div id="localizacao">
        <h3>YPY Salvador 01</h3>
    </div>

    <div id="dados-localizacao">

        <div class="localizacao">
            <div class="icones">
                <i class="fas fa-map-marker-alt"></i>
            </div>

            <div class="text">
                <span class="informations text1"> </span>
            </div>

        </div>

        <br>

        <div class="contato">

            <div class="icones">
                <i class="fas fa-phone"></i>
            </div>

            <div class="text">
                <span class="informations text2">  </span>
            </div>

        </div>

        <br>
        <div class="contato-email">

            <div class="icones">
                <i class="fas fa-envelope"></i>
            </div>

            <div class="text">
                <span class="informations text3"> </span>
            </div>

        </div>

    </div>

    <script>


        $('#main').click();

        function change_pin(data) {
            switch (data) {
                case 'estado01':
                    $('.informations').empty();
                        $('.text1').append(`Rua Clovis Spinola, n° 40, Loja, Bloco A.Ed.Orixás Center,  politeama, Salvador / BA Ponto de Referência: No centro comercial Orixás Center   CEP: 40080-241`);
                        $('.text2').append(`(71)3329-6518 | (71) 3498-1550 | (71) 98870-6051 | (71)99122-2549`);
                        $('.text3').append(`camila.salvador@franqueadoypy.com.br rafael.salvador@franqueadoypy.com.br`);
                        console.log('Show');
                     break;

                case 'estado02':
                    $('.informations').empty();
                        $('.text1').append(`Rua Lenadro Martins Costa, n° 81, Empresa, politeama, Salvador / BA CEP: 35300-110`);
                        $('.text2').append(`(71)3329-6518 | (71) 3498-1550 | (71) 98870-6051`);
                        $('.text3').append(`versatecnologia@franqueadoypy.com.br`);
                    console.log('Show1');
                    break;

                default:
                    console.log(`Sorry, we are out of ${expr}.`);
            }
        }

    </script>

</section>

<?php get_footer(); ?>