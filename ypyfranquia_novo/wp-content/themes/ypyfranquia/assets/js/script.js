$(document).ready(function () {

  //Classe para evento de hover
  const eventHover = {
      ativaHover(element, el, classe) {
        $(element).hover(function() {
          $(el).toggleClass(classe)
        })
      }
  }

  $('.carousel-indicators').children().css( 'background-color', 'black' );
  $('.carousel-indicators').css('position', 'relative');
  $('.carousel-inner .carousel-item:first-child').addClass('active');
 

  eventHover.ativaHover('.botao-hover', '.botao-hover', 'animate__animated animate__rubberBand');
  eventHover.ativaHover('#botao-hover1', '.botao-hover1', 'animate__animated animate__rubberBand');
  eventHover.ativaHover('.botao-img', '.botao-img', 'animate__animated animate__rubberBand');
  eventHover.ativaHover('.btn-blog', '.btn-blog', 'animate__animated animate__heartBeat')
  eventHover.ativaHover('#botao-franqueado', '#btn-azul', 'animate__animated animate__heartBeat')



  $('.carousel-control-next').click( () => { $('.carousel-control-next').css('color', '#bd3939');  });

  $('.link-scroll').click(function () {
    var id = $(this).attr('href');
    var targetOffset = $(id).offset().top;
    $('html, body').animate({
      scrollTop: targetOffset - 100
    }, 1200);
  });


  //======================= FORMATANDO COMENTARIOS ====================
  $('#author').attr('placeholder', 'Nome')
  $('#email').attr('placeholder', 'Email')
  $('#comment').attr('placeholder', 'Mensagem')
  //==================================================================

  jQuery('.responsive').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 2,
    autoplay: true,
    dots: false,
    arrows:true,
    prevArrow:"<button type='button' class='slick-setas-left slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow:"<button type='button' class='slick-setas-right slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          arrows: false,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

 $('.wpcf7-form input').addClass('form-contato')
 $('.wpcf7-form select').addClass('select-form')

  $('#menu-item-379').on('mouseover', function () {
    $('.dropdown-menu').addClass('show')
    $(this).addClass('show')
  })

  $('#menu-item-379').on('mouseout', function () {
    $('.dropdown-menu').removeClass('show')
    $(this).removeClass('show')
  })


});





