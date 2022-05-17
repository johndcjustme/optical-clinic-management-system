<!DOCTYPE html>
{{-- <html lang="en"> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('SCSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.0.0-web/css/all.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" type="x-icon" href="images/shortcut-icon2.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">




    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}



    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
    
    
    


    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>


    {{-- <link rel="stylesheet" href="{{ asset('js/jquery-3.6.0.min.js') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('Scandia-Regular/style.css') }}"> --}}
    
    {{-- <title>Document</title> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="{{ asset('mystyle/css.css') }}">
   



  <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>






    <style>
        .x-dashed-top-2 {
            border-top: 2px dashed rgb(194, 194, 194);
        }

        .x-notification-panel .x-action-links  {
            transition: 0.2s ease-in-out;
            opacity: 0;
        }

        .x-notification-panel:hover .x-action-links {
            opacity: 1; 
        }

        .noscroll {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
          }
        .noscroll::-webkit-scrollbar {
            display: none;
        }




        .ui.steps .step:after {
            z-index: 1;
        }






      .blocker {
        z-index: 1000;
      }  

      .hidden.menu {
        display: none;
      }
  
      .masthead.segment {
        min-height: 700px;
        padding: 1em 0em;
      }
      .masthead .logo.item img {
        margin-right: 1em;
      }
      .masthead .ui.menu .ui.button {
        margin-left: 0.5em;
      }
      .masthead h1.ui.header {
        margin-top: 3em;
        margin-bottom: 0em;
        font-size: 4em;
        font-weight: normal;
      }
      .masthead h2 {
        font-size: 1.7em;
        font-weight: normal;
      }
  
      .ui.vertical.stripe {
        padding: 8em 0em;
      }
      .ui.vertical.stripe h3 {
        font-size: 2em;
      }
      .ui.vertical.stripe .button + h3,
      .ui.vertical.stripe p + h3 {
        margin-top: 3em;
      }
      .ui.vertical.stripe .floated.image {
        clear: both;
      }
      .ui.vertical.stripe p {
        font-size: 1.33em;
      }
      .ui.vertical.stripe .horizontal.divider {
        margin: 3em 0em;
      }
  
      .quote.stripe.segment {
        padding: 0em;
      }
      .quote.stripe.segment .grid .column {
        padding-top: 5em;
        padding-bottom: 5em;
      }
  
      .footer.segment {
        padding: 5em 0em;
      }
  
      .secondary.pointing.menu .toc.item {
        display: none;
      }
  
      @media only screen and (max-width: 700px) {
        .ui.fixed.menu {
          display: none !important;
        }
        .secondary.pointing.menu .item,
        .secondary.pointing.menu .menu {
          display: none;
        }
        .secondary.pointing.menu .toc.item {
          display: block;
        }
        .masthead.segment {
          min-height: 350px;
        }
        .masthead h1.ui.header {
          font-size: 2em;
          margin-top: 1.5em;
        }
        .masthead h2 {
          margin-top: 0.5em;
          font-size: 1.5em;
        }
      }
  


    </style>



  <script>


    function myFunction() {
      console.log('hey')
    }


      $('.ui.dropdown').dropdown();


      $('.table-inventory-dropdown-image').dropdown();


      $('.select_dropdown_modal').dropdown();




      window.addEventListener('confirm-dialog', event => {
          var title = document.getElementById('modal-title');
          var content = document.getElementById('modal-content');

          title.innerHTML = event.detail.title;
          content.innerHTML = event.detail.content;

          $("#fade").modal({
              fadeDuration: 100,
              showClose: false
          });
      })

      window.addEventListener('form-modal', event => {
          $('#form-modal').modal({
              fadeDuration: 75,
              showClose: false
          })
      })

      window.addEventListener('confirm-dialog-close', event => {
          $.modal.close();
      })

      window.addEventListener('toast', event => {
          $('body')
          .toast({
              title: event.detail.title,
              class: event.detail.class,
              showIcon: 'check',
              message: event.detail.message,
              closeOnClick: true,
              compact: true,
              position: 'bottom right',
              cloneModule: false,
          });
      })








  $(document)
  .ready(function() {

  // fix menu when passed
  $('.masthead')
    .visibility({
      once: false,
      onBottomPassed: function() {
        $('.fixed.menu').transition('fade in');
      },
      onBottomPassedReverse: function() {
        $('.fixed.menu').transition('fade out');
      }
    })
  ;

  // create sidebar and attach to menu open
  $('.ui.sidebar')
    .sidebar('attach events', '.toc.item')
  ;

  })
  ;



  </script>
            




    @livewireStyles
</head>
<body class="">
