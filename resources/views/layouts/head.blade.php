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


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/menu.min.css" integrity="sha512-uwNCCTi8OBVqs7T50a7SdH9geEriEus/RP4rXkZY/WlGLE1ppk7YClvhSWKkqgTZF2QJG1e46NHBnZMBFc8NqA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/dropdown.min.css" integrity="sha512-dk0mr0UimoSxsXmBqdTi1CZYBpk7KTF+NCSdownD5SfzXzZ5rqVzd5Qj5yb/qYwtrgd2woHGjgN7Vd4OGlHEZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/dropdown.min.js" integrity="sha512-yp5kS1Lo3/1sNALd7fEOpe8+BMQMgVhrgmp1/jSR0h/PfrncJtU6rUhMXejcUbjneRkjnvY2cxkQ/PrMyeYXiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/transition.min.css" integrity="sha512-akDIy9PFLHqt+/oOhrmqIr57bs4LvCdlUhHmZh5pzmaWG2G3lwzLB9ht56vvz18nKOuC0ItlSK9mPl6oQEAxaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/transition.min.js" integrity="sha512-YKv9jhCJ4S5fNeKwyCHfwI2uLEhekfSOdunDd+xPYaiipsBvywP4ZIpXgyYUN884a/CnI4tNKMA9bs/YqdXU8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/toast.min.css" integrity="sha512-RdgbDqY+sqOZIrI/mvCIQdM90u25aigG4f1XzDSDJeOXTYIo6V6gEiSzULelTD4diwdg/f6JwJHizQ25rNbN9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/toast.min.js" integrity="sha512-r3EKTA05GOQyYSORYBT5yzjv2nRI+6K3gx2kGMUviQyWxW/FEnzrzw+DBt86XLWKqAcziPMIyly5BUbBZGmkhg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/calendar.min.css" integrity="sha512-YMOku2w6GlNR+3OccEnX7VlS43pNjkceykyx9hSJu+m1ebFrtnr/3JVx65af4eljaKS+NXeWxzmJOpSKCuv0uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/calendar.min.js" integrity="sha512-oVraV+9/ALlfWxnjMR8IiAnm098GFRrioH0I104paOHYSsQiFgEeNRCEjWNYsRWBsVvIg7VwJl+ZwF5AUBwdKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/input.min.css" integrity="sha512-r7bXHt85Fpo1H7QMirf3ska2hOsAJVjSKO+jXJWzsavYOp5Bgd3KaFbT8eKbkVthKZljes3dy/z1YprEH7sQfQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/popup.min.css" integrity="sha512-aUX4wbMRLt0b2PAVd6U2u6Zg0/SAblTowDv7EWWt8qFsSV29VhNMxrnezhY4e12V01k1VxyjHgrb833YCwZjYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/popup.min.js" integrity="sha512-wTouu7nW4RnOIMmIwhda1Rnclnq7o/DC4qELndYmFTTjh2MubY09Gak2n2Y/FRgy0Ie5k1681sJ78KxuFGsXYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/button.min.css" integrity="sha512-vlrIlBkiSuDKWjCFXM84tMjRY6cjCv0NCCRAV7cx6m6131opdd8wsj1CW8074yqCbhdpvu87EDA40ChqLQ33Wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/list.min.css" integrity="sha512-R9Ze6LpkNrSknfEEMftdldSt5YQCQtJPf/3AtL38xqE3ftFPj4kwO0nTodrDbe+/zGwLYkCqXISog9Ytnq5X6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/components/grid.min.css">




  <title>{{ config('app.name', 'Dango Optical') }}</title>

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

  {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}


  <link rel="stylesheet" href="{{ mix('css/app.css') }}">



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




        .blocker {
          position: fixed;
          top: 0; right: 0; bottom: 0; left: 0;
          width: 100%; height: 100%;
          overflow: auto;
          z-index: 1;
          padding: 20px;
          box-sizing: border-box;
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0,0.75);
          text-align: center;
        }
        .blocker:before{
          content: "";
          display: inline-block;
          height: 100%;
          vertical-align: middle;
          margin-right: -0.05em;
        }
        .blocker.behind {
          background-color: transparent;
        }
        
        .pointer-events-none {
          pointer-events: none;
        }

        table.tbl-exam tr, 
        table.tbl-exam td {
            padding: 0.4em;
            margin: 0;
            border-bottom: none;
        }



        .x_modal {
            display: none;
            vertical-align: middle;
            position: relative;
            z-index: 2;
            max-width: 500px;
            box-sizing: border-box;
            width: 90%;
            background: #fff;
            padding: 1.5em;
            -webkit-border-radius: 1em;
            -moz-border-radius: 1em;
            -o-border-radius: 1em;
            -ms-border-radius: 1em;
            border-radius: 1em;
            -webkit-box-shadow: 0 0 10px #000;
            -moz-box-shadow: 0 0 10px #000;
            -o-box-shadow: 0 0 10px #000;
            -ms-box-shadow: 0 0 10px #000;
            box-shadow: 0 0 10px #000;
            text-align: left;
          }

          .x_modal a.close-x_modal {
            position: absolute;
            top: -12.5px;
            right: -12.5px;
            display: block;
            width: 30px;
            height: 30px;
            text-indent: -9999px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAA3hJREFUaAXlm8+K00Acx7MiCIJH/yw+gA9g25O49SL4AO3Bp1jw5NvktC+wF88qevK4BU97EmzxUBCEolK/n5gp3W6TTJPfpNPNF37MNsl85/vN/DaTmU6PknC4K+pniqeKJ3k8UnkvDxXJzzy+q/yaxxeVHxW/FNHjgRSeKt4rFoplzaAuHHDBGR2eS9G54reirsmienDCTRt7xwsp+KAoEmt9nLaGitZxrBbPFNaGfPloGw2t4JVamSt8xYW6Dg1oCYo3Yv+rCGViV160oMkcd8SYKnYV1Nb1aEOjCe6L5ZOiLfF120EjWhuBu3YIZt1NQmujnk5F4MgOpURzLfAwOBSTmzp3fpDxuI/pabxpqOoz2r2HLAb0GMbZKlNV5/Hg9XJypguryA7lPF5KMdTZQzHjqxNPhWhzIuAruOl1eNqKEx1tSh5rfbxdw7mOxCq4qS68ZTjKS1YVvilu559vWvFHhh4rZrdyZ69Vmpgdj8fJbDZLJpNJ0uv1cnr/gjrUhQMuI+ANjyuwftQ0bbL6Erp0mM/ny8Fg4M3LtdRxgMtKl3jwmIHVxYXChFy94/Rmpa/pTbNUhstKV+4Rr8lLQ9KlUvJKLyG8yvQ2s9SBy1Jb7jV5a0yapfF6apaZLjLLcWtd4sNrmJUMHyM+1xibTjH82Zh01TNlhsrOhdKTe00uAzZQmN6+KW+sDa/JD2PSVQ873m29yf+1Q9VDzfEYlHi1G5LKBBWZbtEsHbFwb1oYDwr1ZiF/2bnCSg1OBE/pfr9/bWx26UxJL3ONPISOLKUvQza0LZUxSKyjpdTGa/vDEr25rddbMM0Q3O6Lx3rqFvU+x6UrRKQY7tyrZecmD9FODy8uLizTmilwNj0kraNcAJhOp5aGVwsAGD5VmJBrWWbJSgWT9zrzWepQF47RaGSiKfeGx6Szi3gzmX/HHbihwBser4B9UJYpFBNX4R6vTn3VQnez0SymnrHQMsRYGTr1dSk34ljRqS/EMd2pLQ8YBp3a1PLfcqCpo8gtHkZFHKkTX6fs3MY0blKnth66rKCnU0VRGu37ONrQaA4eZDFtWAu2fXj9zjFkxTBOo8F7t926gTp/83Kyzzcy2kZD6xiqxTYnHLRFm3vHiRSwNSjkz3hoIzo8lCKWUlg/YtGs7tObunDAZfpDLbfEI15zsEIY3U/x/gHHc/G1zltnAgAAAABJRU5ErkJggg==');

          }

          .x_modal-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translateY(-50%) translateX(-50%);
            padding: 12px 16px;
            border-radius: 5px;
            background-color: #111;
            height: 20px;
          }

          .x_modal-spinner > div {
            border-radius: 100px;
            background-color: #fff;
            height: 20px;
            width: 2px;
            margin: 0 1px;
            display: inline-block;

            -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
            animation: sk-stretchdelay 1.2s infinite ease-in-out;
          }

          .x_modal-spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
          }

          .x_modal-spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
          }

          .x_modal-spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
          }

          @-webkit-keyframes sk-stretchdelay {
            0%, 40%, 100% { -webkit-transform: scaleY(0.5) }
            20% { -webkit-transform: scaleY(1.0) }
          }

          @keyframes sk-stretchdelay {
            0%, 40%, 100% {
              transform: scaleY(0.5);
              -webkit-transform: scaleY(0.5);
            }  20% {
              transform: scaleY(1.0);
              -webkit-transform: scaleY(1.0);
            }
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
  



      @media(max-width:1520px) {
            .left-svg {
                display: none;
            }
        }

        /* small css for the mobile nav close */
        #nav-mobile-btn.close span:first-child {
            transform: rotate(45deg);
            top: 4px;
            position: relative;
            background: #a0aec0;
        }

        #nav-mobile-btn.close span:nth-child(2) {
            transform: rotate(-45deg);
            margin-top: 0px;
            background: #a0aec0;
        }


    </style>



  <script>

      $('.ui.dropdown').dropdown();


      $('.table-inventory-dropdown-image').dropdown();


      $('.select_dropdown_modal').dropdown();




      window.addEventListener('confirm-dialog', event => {
          var title = document.getElementById('modal-title');
          var content = document.getElementById('modal-content');
          
          title.innerHTML = event.detail.title;
          content.innerHTML = event.detail.content;
          
          // document.getElementById('confirm-me').checked = true;

          $("#confirm-me").modal({
              fadeDuration: 100,
              showClose: false
          });
      });

      window.addEventListener('form-modal', event => {
          $('#form-modal').modal({
              fadeDuration: 75,
              showClose: false
          })
      });

      window.addEventListener('confirm-dialog-close', event => {

        $.modal.close();

      });

      window.addEventListener('toast', event => {
          $('body')
          .toast({
              title: event.detail.title,
              class: event.detail.class,
              showIcon: 'fa-solid fa-info-circle',
              message: event.detail.message,
              closeOnClick: true,
              compact: true,
              position: 'bottom right',
              cloneModule: false,
          });
      });








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
<body>

