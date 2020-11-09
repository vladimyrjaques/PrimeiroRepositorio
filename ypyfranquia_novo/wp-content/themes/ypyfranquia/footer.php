<footer id="rodape">
    <div class="container">
        <div class="row justify-content-center">

          <div class="col-lg-4 mt-5">

               <div class="ml-auto" id="menu-footer">
                   <ul class="navbar-nav p-2">

                       <li class="menu-item">
                           <a href="/home" class="nav-link">Home</a>
                       </li>

                       <li class="menu-item">
                           <a href="/solucoes" class="nav-link">Soluções</a>
                       </li>

                       <li class="menu-item">
                           <a href="/blog" class="nav-link">Blog</a>
                       </li>

                       <li class="menu-item">
                           <a href="/financiamento/" class="nav-link">Quero um empréstimo</a>
                       </li>

                   </ul>
               </div>

              <?php
              if (has_nav_menu('menu_footer')) {
                  wp_nav_menu(array(
                      'menu' => 'menu_footer',
                      'container' => 'div',
                      'container_class' => 'ml-auto',
                      'container_id' => 'menu_top',
                      'menu_class' => 'navbar-nav p-2',
                  ));
              }              i
              ?>

          </div>

          <div class="col-lg-4 mt-5 text-center">
              <div id="conteudo-col2 ">
                  <h5>Matriz YPY</h5>
                  <p>Rua Cornélio Pena,255 <br>
                  Quartoze de Fevereiro, Itabira - MG <br>
                  CEP: 35900-241</p>

                  <p>E-mail: contato@ypypfranquia.com.br</p>
              </div>
          </div>

          <div class="col-lg-4 mt-5">
              <h5 align="center">Conheça nossas redes sociais</h5>
              <div class="icones-rodape ">
                  <a href="https://www.facebook.com/ypysolucoes/" target="_blank"> <img class="img-fluid img-icones-rodape" src="<?= URL?>/assets/img/facebook.png" alt=""> </a>
                  <a href="https://www.instagram.com/ypydivinopolis3/" target="_blank"> <img class="img-fluid img-icones-rodape" src="<?= URL?>/assets/img/instagram.png" alt=""> </a>
                  <a href="https://www.linkedin.com/company/ypyfranquia/" target="_blank"> <img class="img-fluid img-icones-rodape" src="<?= URL?>/assets/img/linkedin.png" alt=""> </a>
              </div>
              <div class="justify-content-center" align="center">
                <h5 align="center">Seja um Franqueado</h5>
                <a class="btn btn-secondary seja-franqueado" href="https://www.ypyfranquia.com.br/" target="_blank">Clique aqui</a>
              </div>
          </div>

        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<?php wp_footer(); ?>
</body>
</html>
