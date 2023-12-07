<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="{{asset('storage/css/style.css')}}" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{ asset('storage/css/select2.css') }}">

        <script src="{{ asset('storage/js/jquery.min.js') }}"></script>
        <script src="{{ asset('storage/js/select2.min.js') }}"></script>

        <!-- Styles -->
        @livewireStyles
</head>

<body

class=""
 >
  <!-- ===== Preloader Start ===== -->
  <!-- @include('partials.preloader') -->
  <!-- ===== Preloader End ===== -->

  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <!-- ===== Sidebar Start ===== -->     
    @include('partials.sidebar')
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="content-area relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <!-- ===== Header Start ===== -->
      <!-- <include src="./partials/header.html" />dfgdfg -->
      @include('partials.header')
      <!-- ===== Header End ===== -->

      <!-- ===== Main Content Start ===== -->
      <main>
	  
	  <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow sticky top-[80px]">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
		
		
          {{ $slot }}
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->
</body>

</html>


<script>

  function hideMenu(){
      var menus = document.querySelectorAll('.dropdown');
      menus.forEach(function (elemento) {
        elemento.classList.add('hidden')
      })
      //capturo todos los menus
      //cuando se posa el mouse encima de uno debo mostrar el menu
      //elemento.classList.add('hidden');
      //this.nextElementSibling.classList.add('hidden')
    }

  document.addEventListener('DOMContentLoaded',function(){    
      
    
    // Hide or show dropdown menu in header's buttons bar
    var openMenuOptions = document.querySelectorAll('.menu');
    openMenuOptions.forEach(function(elemento){

        
         elemento.addEventListener('click',function(){
          //console.log(elemento.id);
          if(elemento.id == 'userarea'){
            var menu = elemento.nextElementSibling; 
            menu.classList.toggle('hidden');   
            document.getElementById('notification').nextElementSibling.classList.add('hidden');
            document.getElementById('messages').nextElementSibling.classList.add('hidden');
          };
          if(elemento.id == 'notification'){
            var menu = elemento.nextElementSibling; 
            menu.classList.toggle('hidden');   
            document.getElementById('userarea').nextElementSibling.classList.add('hidden');
            document.getElementById('messages').nextElementSibling.classList.add('hidden');
          };
          if(elemento.id == 'messages'){
            var menu = elemento.nextElementSibling; 
            menu.classList.toggle('hidden');   
            document.getElementById('notification').nextElementSibling.classList.add('hidden');
            document.getElementById('userarea').nextElementSibling.classList.add('hidden');
          };
         
          
         
          })
         });  
        //  elemento.addEventListener('onmouseenter',function(){
        //   var menu = elemento.nextElementSibling; 
        //   menu.classList.toggle('hidden');          
        //  });       
   

     //selecciono todos los dropdown
     var drop = document.querySelectorAll('.dropdown');
     drop.forEach(function(elemento){   
      
        elemento.addEventListener('mouseleave',function(){ 
           //console.log(elemento) 
           elemento.classList.add('hidden')
        });
     });

     //selecciono todos los dropdown
    //  var drop = document.querySelectorAll('.menu');
    //  drop.forEach(function(elemento){   
      
    //     elemento.addEventListener('mouseleave',function(){ 
    //        //console.log(elemento) 
    //       // alert(4545)
    //       // elemento.nextElementSibling.classList.add('hidden')
    //     });
    //  });
   
 
    // Add click event to sidebar's links with group class for collapse or open the dropdown menu
    // inside them
    var groupMenuOptions = document.querySelectorAll('.group');
    groupMenuOptions.forEach(function(elemento) {
      elemento.addEventListener('click',function(){
           var menu = elemento.nextElementSibling;
           menu.classList.toggle('hidden');
      });       
    });

    // Button that hide the sidebar
    var sidebarToggle = document.getElementById('sidebarToggle');
    sidebarToggle.addEventListener('click',function() {
      document.querySelector('.sidebar').classList.toggle('-translate-x-full');
    });

    // Open sidebar with hamburguer button
    var button = document.querySelector('.hamburguer');
    button.addEventListener('click',function(){    
      document.querySelector('.sidebar').classList.toggle('-translate-x-full');  
    })
     
   //  Dark Mode Toggler 
   document.querySelector('li.dark-mode').addEventListener('click',function(){       
       document.querySelector('.dark-mode label').classList.toggle('bg-stroke');
       document.querySelector('.dark-mode label').classList.toggle('bg-primary');
        
       document.querySelector('.dark-mode label span').classList.toggle('!right-[3px]');
       document.querySelector('.dark-mode label span').classList.toggle('!translate-x-full');

       document.querySelector('body').classList.toggle('dark');
       document.querySelector('body').classList.toggle('text-bodydark');
       document.querySelector('body').classList.toggle('bg-boxdark-2');
    });

   

  });


</script>

