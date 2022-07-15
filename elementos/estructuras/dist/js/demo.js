/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */

var BarraNavegacion='';
var varianteAcente='';
var BarraLateral='';
var BarraNavegacionLigera='';
var logoTipo='';


(function ($) {
  'use strict'

  var $sidebar   = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $sidebar.append($container)

  var navbar_dark_skins = [
    'navbar-primary',
    'navbar-secondary',
    'navbar-info',
    'navbar-success',
    'navbar-danger',
    'navbar-indigo',
    'navbar-purple',
    'navbar-pink',
    'navbar-teal',
    'navbar-cyan',
    'navbar-dark',
    'navbar-gray-dark',
    'navbar-gray',
  ]

  var navbar_light_skins = [
    'navbar-light',
    'navbar-warning',
    'navbar-white',
    'navbar-orange',
  ]

  $container.append(
    '<h5>Configuración</h5><hr class="mb-2"/>'
  )

  var $no_border_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-header').hasClass('border-bottom-0'),
    'class': 'mr-1',
    'id': 'guardarBorder'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('border-bottom-0')
    } else {
      $('.main-header').removeClass('border-bottom-0')
    }
  })
  var $no_border_container = $('<div />', {'class': 'mb-1'}).append($no_border_checkbox).append('<span>Sin borde de barra de navegación</span>')
  $container.append($no_border_container)

  var $text_sm_body_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('body').hasClass('text-sm'),
    'class': 'mr-1',
    'id': 'guardarTextoPequeñoCuerpo'
  }).on('click', function () {

    if ($(this).is(':checked')) {
      $('body').addClass('text-sm')
    } else {
      $('body').removeClass('text-sm')
    }
  })


  var $text_sm_body_container = $('<div />', {'class': 'mb-1'}).append($text_sm_body_checkbox).append('<span>Texto pequeño del cuerpo</span>')
  $container.append($text_sm_body_container)

  var $text_sm_header_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-header').hasClass('text-sm'),
    'class': 'mr-1',
    'id': 'guardarTextoPequeñoBarraNave'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('text-sm')
    } else {
      $('.main-header').removeClass('text-sm')
    }
  })
  var $text_sm_header_container = $('<div />', {'class': 'mb-1'}).append($text_sm_header_checkbox).append('<span>Texto pequeño de la barra de navegación</span>')
  $container.append($text_sm_header_container)

  var $text_sm_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('text-sm'),
    'class': 'mr-1',
    'id': 'guardarTextoPequeñoBarraNaveLateral'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('text-sm')
    } else {
      $('.nav-sidebar').removeClass('text-sm')
    }
  })
  var $text_sm_sidebar_container = $('<div />', {'class': 'mb-1'}).append($text_sm_sidebar_checkbox).append('<span>Texto pequeño de navegación de la barra lateral</span>')
  $container.append($text_sm_sidebar_container)

  var $text_sm_footer_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-footer').hasClass('text-sm'),
    'class': 'mr-1',
     'id': 'guardarTextoPequeñoPiePag'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-footer').addClass('text-sm')
    } else {
      $('.main-footer').removeClass('text-sm')
    }
  })
  var $text_sm_footer_container = $('<div />', {'class': 'mb-1'}).append($text_sm_footer_checkbox).append('<span>Texto pequeño de pie de página</span>')
  $container.append($text_sm_footer_container)

  var $flat_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-flat'),
    'class': 'mr-1',
     'id': 'guardarTextoPequeñoPiePag2'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-flat')
    } else {
      $('.nav-sidebar').removeClass('nav-flat')
    }
  })
  var $flat_sidebar_container = $('<div />', {'class': 'mb-1'}).append($flat_sidebar_checkbox).append('<span>Texto pequeño de pie de página</span>')
  $container.append($flat_sidebar_container)

  var $legacy_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-legacy'),
    'class': 'mr-1',
     'id': 'guardarTextoPequeñoPiePag3'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-legacy')
    } else {
      $('.nav-sidebar').removeClass('nav-legacy')
    }
  })
  var $legacy_sidebar_container = $('<div />', {'class': 'mb-1'}).append($legacy_sidebar_checkbox).append('<span>Texto pequeño de pie de página</span>')
  $container.append($legacy_sidebar_container)

  var $compact_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-compact'),
    'class': 'mr-1',
     'id': 'guardarBarraNaveg'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-compact')
    } else {
      $('.nav-sidebar').removeClass('nav-compact')
    }
  })
  var $compact_sidebar_container = $('<div />', {'class': 'mb-1'}).append($compact_sidebar_checkbox).append('<span>Barra lateral de navegación compacta</span>')
  $container.append($compact_sidebar_container)

  var $child_indent_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-child-indent'),
    'class': 'mr-1',
     'id': 'guardarBarraSangria'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-child-indent')
    } else {
      $('.nav-sidebar').removeClass('nav-child-indent')
    }
  })
  var $child_indent_sidebar_container = $('<div />', {'class': 'mb-1'}).append($child_indent_sidebar_checkbox).append('<span>Sangría secundaria de navegación de la barra lateral</span>')
  $container.append($child_indent_sidebar_container)

  var $no_expand_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-sidebar').hasClass('sidebar-no-expand'),
    'class': 'mr-1',
     'id': 'guardarBarraLaterialFI'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-sidebar').addClass('sidebar-no-expand')
    } else {
      $('.main-sidebar').removeClass('sidebar-no-expand')
    }
  })
  var $no_expand_sidebar_container = $('<div />', {'class': 'mb-1'}).append($no_expand_sidebar_checkbox).append('<span>Barra lateral principal deshabilitar desplazamiento / enfoque de expansión automática</span>')
  $container.append($no_expand_sidebar_container)

  var $text_sm_brand_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.brand-link').hasClass('text-sm'),
    'class': 'mr-1',
     'id': 'guardarMarca'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.brand-link').addClass('text-sm')
    } else {
      $('.brand-link').removeClass('text-sm')
    }
  })
  var $text_sm_brand_container = $('<div />', {'class': 'mb-4'}).append($text_sm_brand_checkbox).append('<span>Texto pequeño de la marca</span>')
  $container.append($text_sm_brand_container)

  $container.append('<h6>Barra Navegación Superior</h6>')

  var $navbar_variants        = $('<div />', {
    'class': 'd-flex',
  })
  var navbar_all_colors       = navbar_dark_skins.concat(navbar_light_skins)

  var $navbar_variants_colors = createSkinBlock(navbar_all_colors, function (e) {
    var color = $(this).data('color')
    var $main_header = $('.main-header')
   
    $main_header.removeClass('navbar-dark').removeClass('navbar-light')
    navbar_all_colors.map(function (color) {
      $main_header.removeClass(color)
    })

     if (navbar_dark_skins.indexOf(color) > -1) {
      $main_header.addClass('navbar-dark')
      BarraNavegacion='navbar-dark ';
    } else {
      $main_header.addClass('navbar-light')
      BarraNavegacion='navbar-light ';
    }
    $main_header.addClass(color)
    BarraNavegacion+=color;
  })

  $navbar_variants.append($navbar_variants_colors)

  $container.append($navbar_variants)

  var sidebar_colors = [
    'bg-primary',
    'bg-warning',
    'bg-info',
    'bg-danger',
    'bg-success',
    'bg-indigo',
    'bg-navy',
    'bg-purple',
    'bg-fuchsia',
    'bg-pink',
    'bg-maroon',
    'bg-orange',
    'bg-lime',
    'bg-teal',
    'bg-olive'
  ]

  var accent_colors = [
    'accent-primary',
    'accent-warning',
    'accent-info',
    'accent-danger',
    'accent-success',
    'accent-indigo',
    'accent-navy',
    'accent-purple',
    'accent-fuchsia',
    'accent-pink',
    'accent-maroon',
    'accent-orange',
    'accent-lime',
    'accent-teal',
    'accent-olive'
  ]

  var sidebar_skins = [
    'sidebar-dark-primary',
    'sidebar-dark-warning',
    'sidebar-dark-info',
    'sidebar-dark-danger',
    'sidebar-dark-success',
    'sidebar-dark-indigo',
    'sidebar-dark-navy',
    'sidebar-dark-purple',
    'sidebar-dark-fuchsia',
    'sidebar-dark-pink',
    'sidebar-dark-maroon',
    'sidebar-dark-orange',
    'sidebar-dark-lime',
    'sidebar-dark-teal',
    'sidebar-dark-olive',
    'sidebar-light-primary',
    'sidebar-light-warning',
    'sidebar-light-info',
    'sidebar-light-danger',
    'sidebar-light-success',
    'sidebar-light-indigo',
    'sidebar-light-navy',
    'sidebar-light-purple',
    'sidebar-light-fuchsia',
    'sidebar-light-pink',
    'sidebar-light-maroon',
    'sidebar-light-orange',
    'sidebar-light-lime',
    'sidebar-light-teal',
    'sidebar-light-olive'
  ]

  $container.append('<h6>Colores de Hipervínculos</h6>')
  var $accent_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($accent_variants)
  $container.append(createSkinBlock(accent_colors, function () {
    var color         = $(this).data('color')
    var accent_class = color
    var $body      = $('body')
    varianteAcente=color;
    
    accent_colors.map(function (skin) {
     
      $body.removeClass(skin)
    })

    $body.addClass(accent_class)
  }))

  $container.append('<h6>Barra de Lateral Osculo/Colores</h6>')
  var $sidebar_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($sidebar_variants)
  $container.append(createSkinBlock(sidebar_colors, function () {
    sidebar_class='';
    var color         = $(this).data('color')
    var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '')
    var $sidebar      = $('.main-sidebar')
    
   
    sidebar_skins.map(function (skin) {
      $sidebar.removeClass(skin)

     
    })


     console.log(sidebar_class);

    $sidebar.addClass(sidebar_class)
    BarraLateral=sidebar_class;

   
  }))

  $container.append('<h6>Barra de Lateral Claro/Colores</h6>')
  var $sidebar_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($sidebar_variants)
  $container.append(createSkinBlock(sidebar_colors, function () {
    sidebar_class='';
    var color         = $(this).data('color')
    var sidebar_class = 'sidebar-light-' + color.replace('bg-', '')
    var $sidebar      = $('.main-sidebar')
       
  
    sidebar_skins.map(function (skin) {
      $sidebar.removeClass(skin)
     
    })

      console.log(sidebar_class);

    $sidebar.addClass(sidebar_class)

     BarraLateral=sidebar_class;
  }))

  var logo_skins = navbar_all_colors
  $container.append('<h6>Barra Superior-Logotipo</h6>')
  var $logo_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($logo_variants)
  var $clear_btn = $('<a />', {
    href: 'javascript:void(0)',
    id:'guardarFinalTotal'
  }).text('Guardar').on('click', function () {
    
  })
  $container.append(createSkinBlock(logo_skins, function () {
    var color = $(this).data('color')

    var $logo = $('.brand-link')
    logo_skins.map(function (skin) {
      $logo.removeClass(skin)
      console.log(skin)
    })
    $logo.addClass(color)

    logoTipo=color;

  }).append($clear_btn))

  function createSkinBlock(colors, callback) {
    var $block = $('<div />', {
      'class': 'd-flex flex-wrap mb-3'
    })

    colors.map(function (color) {
      var $color = $('<div />', {
        'class': (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-') + ' elevation'
      })

      $block.append($color)

      $color.data('color', color)


      $color.css({
        width       : '40px',
        height      : '20px',
        borderRadius: '25px',
        marginRight : 10,
        marginBottom: 10,
        opacity     : 0.8,
        cursor      : 'pointer'
      })

      $color.hover(function () {
        $(this).css({ opacity: 1 }).removeClass('elevation').addClass('elevation-4')
      }, function () {
        $(this).css({ opacity: 0.8 }).removeClass('elevation-4').addClass('elevation')
      })

      if (callback) {
        $color.on('click', callback)
      }
    })

    return $block
  }
})(jQuery)


estilos();








// $('.guardarTextos')[0]. checked = true;


















// guardar





$('#guardarFinalTotal').click(function(){







     ret=`<div class="col-12"> 
                <div class="form-group">
                
                <input type="password" class="form-control" id="pass">
                </div> 
            </div>`;


                  Swal.fire({
              title: 'INGRESE SU CONTRASEÑA',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  password = document.getElementById('pass').value;

                  guardarEstilos(BarraNavegacion,varianteAcente,BarraLateral,logoTipo,password);
                  
                                  
                }
        });



});




function guardarEstilos(BarraNavegacion,varianteAcente,BarraLateral,logoTipo,password){

borde=0;
textoCuerpoPequeño=0;
textoCuerpoPequeñoNavegacion=0;
textoCuerpoPequeñoNavegacionLateral=0;
textoPiePagina=0;
textoPiePaginaDos=0;
textoPiePaginaTres=0;
barraVa=0;
sangria=0;
barraInfer=0;
marcaAgua=0;





  if ($('#guardarBorder').is(':checked')) {
     borde=1;
    }


  if ($('#guardarTextoPequeñoCuerpo').is(':checked')) {
     textoCuerpoPequeño=1;
    }

  if ($('#guardarTextoPequeñoBarraNave').is(':checked')) {
     textoCuerpoPequeñoNavegacion=1;
    }


if ($('#guardarTextoPequeñoBarraNaveLateral').is(':checked')) {
    textoCuerpoPequeñoNavegacionLateral=0;
    }

if ($('#guardarTextoPequeñoPiePag').is(':checked')) {
     textoPiePagina=1;
    }



if ($('#guardarTextoPequeñoPiePag2').is(':checked')) {
     textoPiePaginaDos=1;
    }

if ($('#guardarTextoPequeñoPiePag3').is(':checked')) {
     textoPiePaginaTres=1;
    }
if ($('#guardarBarraNaveg').is(':checked')) {
     barraVa=1;
    }

if ($('#guardarBarraSangria').is(':checked')) {
     sangria=1;
    }


if ($('#guardarBarraLaterialFI').is(':checked')) {
     barraInfer=1;
    }

if ($('#guardarMarca').is(':checked')) {
     marcaAgua=1;
    } 
opcion=2;
console.log({opcion:opcion,borde:borde, textoCuerpoPequeño:textoCuerpoPequeño, textoCuerpoPequeñoNavegacion:textoCuerpoPequeñoNavegacion, textoCuerpoPequeñoNavegacionLateral:textoCuerpoPequeñoNavegacionLateral, textoPiePagina:textoPiePagina, textoPiePaginaDos:textoPiePaginaDos, textoPiePaginaTres:textoPiePaginaTres, barraVa:barraVa, sangria:sangria, barraInfer:barraInfer, marcaAgua:marcaAgua, BarraNavegacion:BarraNavegacion, varianteAcente:varianteAcente, BarraLateral:BarraLateral, logoTipo:logoTipo});
    
       $.ajax({
                         url:"../login/modulos/bd/guardarPerfil.php",
                         type:"POST",
        
                         data: {password:password, opcion:opcion, borde:borde, textoCuerpoPequeño:textoCuerpoPequeño, textoCuerpoPequeñoNavegacion:textoCuerpoPequeñoNavegacion, textoCuerpoPequeñoNavegacionLateral:textoCuerpoPequeñoNavegacionLateral, textoPiePagina:textoPiePagina, textoPiePaginaDos:textoPiePaginaDos, textoPiePaginaTres:textoPiePaginaTres, barraVa:barraVa, sangria:sangria, barraInfer:barraInfer, marcaAgua:marcaAgua, BarraNavegacion:BarraNavegacion, varianteAcente:varianteAcente, BarraLateral:BarraLateral, logoTipo:logoTipo}, 
                         success:function(data){ 

                                  console.log(data)    
                             if(data == "Muy Bien 1"){
                                
                                 toastr.success('Tu estilo fue Creado con éxito !!');

                             }else{

                                if(data == "Muy Bien 2"){
                                 
                                   toastr.success('Tu estilo fue Editado con éxito !!');
                                 

                                 }else{

                                    if(data == "Contraseña incorrecta"){
                                     
                              
                                        toastr.error('Contraseña Incorrecta !!');
                                 
                                     }else{

                                    

                                        toastr.error('ERROR SEVIDOR !!');
                                 
                                        console.log(data);
                                     }
                                 }


                             }
                         }    
                      });






//  leer si tiene una clase y cambiar con un boton

       // clase=$('.main-header').hasClass('border-bottom-0');


       // if (clase) {

       //    $('.main-header').addClass('border-bottom-0')
   
       //    $('.main-header').removeClass('border-bottom-0')
     


       // }else{

       //     $('.main-header').removeClass('border-bottom-0')
       //    $('.main-header').addClass('border-bottom-0')
   
     
     

       // }



     
    
}
















function estilos(){

opcion=1;

$.ajax({
                         url:"../login/modulos/bd/guardarPerfil.php",
                         type:"POST",
                         datatype: "json",
                         data: {opcion:opcion}, 
                         success:function(res){               
                         console.log(res)
                          data = res.split('||');

                          borde = data[0];
                          textoCuerpoPequeño = data[1];
                          textoCuerpoPequeñoNavegacion = data[2];
                          textoCuerpoPequeñoNavegacionLateral = data[3];
                          textoPiePagina = data[4];
                          textoPiePaginaDos = data[5];
                          textoPiePaginaTres = data[6];
                          barraVa = data[7];
                          sangria = data[8];
                          barraInfer = data[9];
                          marcaAgua = data[10];

                          // colores

                          BarraNavegacion = data[11];


                          varianteAcente = data[12];
                          BarraLateral = data[13];
                   
                          logoTipo = data[14]; 




                         if (borde==0) {
                          $('.main-header').addClass('border-bottom-0');
                          $('.main-header').removeClass('border-bottom-0');
                         

                         }else{
                          $('.main-header').removeClass('border-bottom-0');
                          $('.main-header').addClass('border-bottom-0');
                          $('#guardarBorder')[0]. checked = true;
                          
                         }  


                         if (textoCuerpoPequeño==0) {
                          $('body').addClass('text-sm');
                          $('body').removeClass('text-sm');
                          

                         }else{
                          $('body').removeClass('text-sm');
                          $('body').addClass('text-sm');
                          $('#guardarTextoPequeñoCuerpo')[0]. checked = true;
                          
                         }   



                         if (textoCuerpoPequeñoNavegacion==0) {
                          $('.main-header').addClass('text-sm');
                          $('.main-header').removeClass('text-sm');
                         

                         }else{
                          $('.main-header').removeClass('text-sm');
                          $('.main-header').addClass('text-sm');
                          $('#guardarTextoPequeñoBarraNave')[0]. checked = true;
                          
                         }   



                          if (textoCuerpoPequeñoNavegacionLateral==0) {
                          $('.nav-sidebar').addClass('text-sm');
                          $('.nav-sidebar').removeClass('text-sm');
                          

                         }else{
                          $('.nav-sidebar').removeClass('text-sm');
                          $('.nav-sidebar').addClass('text-sm');
                          $('#guardarTextoPequeñoBarraNaveLateral')[0]. checked = true;
                          
                         }   



                          if (textoPiePagina==0) {
                          $('.main-footer').addClass('text-sm');
                          $('.main-footer').removeClass('text-sm');
                        

                         }else{
                          $('.main-footer').removeClass('text-sm');
                          $('.main-footer').addClass('text-sm');
                          $('#guardarTextoPequeñoPiePag')[0]. checked = true;
                          
                         }   


                            if (textoPiePaginaDos==0) {
                          $('.nav-sidebar').addClass('nav-flat');
                          $('.nav-sidebar').removeClass('nav-flat');
                       

                         }else{
                          $('.nav-sidebar').removeClass('nav-flat');
                          $('.nav-sidebar').addClass('nav-flat');
                          $('#guardarTextoPequeñoPiePag2')[0]. checked = true;
                          
                         }   



                          if (textoPiePaginaTres==0) {
                          $('.nav-sidebar').addClass('nav-legacy');
                          $('.nav-sidebar').removeClass('nav-legacy');
                       

                         }else{
                          $('.nav-sidebar').removeClass('nav-legacy');
                          $('.nav-sidebar').addClass('nav-legacy');
                          $('#guardarTextoPequeñoPiePag3')[0]. checked = true;
                          
                         }  


                         

                          if (barraVa==0) {
                          $('.nav-sidebar').addClass('nav-compact');
                          $('.nav-sidebar').removeClass('nav-compact');
                      

                         }else{
                          $('.nav-sidebar').removeClass('nav-compact');
                          $('.nav-sidebar').addClass('nav-compact');
                          $('#guardarBarraNaveg')[0]. checked = true;
                          
                         }  


                          if (sangria==0) {
                          $('.nav-sidebar').addClass('nav-child-indent');
                          $('.nav-sidebar').removeClass('nav-child-indent');
                    

                         }else{
                          $('.nav-sidebar').removeClass('nav-child-indent');
                          $('.nav-sidebar').addClass('nav-child-indent');
                          $('#guardarBarraSangria')[0]. checked = true;
                          
                         }  


                         if (barraInfer==0) {
                          $('.main-sidebar').addClass('sidebar-no-expand');
                          $('.main-sidebar').removeClass('sidebar-no-expand');
                        

                         }else{
                          $('.main-sidebar').removeClass('sidebar-no-expand');
                          $('.main-sidebar').addClass('sidebar-no-expand');
                          $('#guardarBarraLaterialFI')[0]. checked = true;
                          
                         }  


                         if (marcaAgua==0) {
                          $('.main-sidebar').addClass('sidebar-no-expand');
                          $('.main-sidebar').removeClass('sidebar-no-expand');
                      

                         }else{
                          $('.main-sidebar').removeClass('sidebar-no-expand');
                          $('.main-sidebar').addClass('sidebar-no-expand');
                          $('#guardarBarraLaterialFI')[0]. checked = true;
                          
                         }  


                        if (BarraNavegacion!='0') {


                        
                        //Barra Navegacion
                        $('.main-header').removeClass('navbar-white navbar-light');
                        $('.main-header').addClass(BarraNavegacion);

                         } 



                          if (varianteAcente!='0') {

                            //Barra Navegacion
                              $('body').addClass(varianteAcente);

                         } 


                         if (BarraLateral!='0') {

                            //Variante Barra Lateral


                            $('.main-sidebar').removeClass('sidebar-dark-primary');
                            $('.main-sidebar').addClass(BarraLateral);


                         } 








                          if (logoTipo!='0') {

                                //-----------------------------------------


                                  var sidFIN = [
                                    'navbar-primary',
                                    'navbar-secondary',
                                    'navbar-info',
                                    'navbar-success',
                                    'navbar-danger',
                                    'navbar-indigo',
                                    'navbar-navy',
                                    'navbar-purple',
                                    'navbar-fuchsia',
                                    'navbar-pink',
                                    'navbar-maroon',
                                    'navbar-orange',
                                    'navbar-lime',
                                    'navbar-teal',
                                    'navbar-olive',
                                    'navbar-gray-dark',
                                    'navbar-light',
                                    'navbar-warning',
                                    'navbar-cyan',
                                    'navbar-white',
                                    'navbar-orange'
                                  ]





                                for (var i = sidFIN.length - 1; i >= 0; i--) {

                                  $('.brand-link').removeClass(sidFIN[i]);
                                }

                                $('.brand-link').addClass(logoTipo);






                         } 



                         }    
                      });


    
}