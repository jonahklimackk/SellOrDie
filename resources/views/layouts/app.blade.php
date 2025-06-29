<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script type="text/javascript" src="/js/jquery.min.7.1.js"></script>
    <!-- <script type="text/javascript" src="/js/send-mailing-form.js"></script> -->
    <script type="text/javascript" src="/js/global.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('styles')



    <script>
        const toggleVisibilityNew = () => {

            const element = document.querySelector(".new-ad-form");
            console.log(element.style.display);

            if (element.style.display === "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>

    <script>
        const toggleVisibilityEdit = () => {

            const element = document.querySelector(".edit-form");
            console.log(element.style.display);

            if (element.style.display === "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>    


                <script src="https://cdn.tiny.cloud/1/hdpfz7m2vgiig2zohze2n23vfx0meivy7flc54tvj7biqkm3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    

    <style>

/*this also highlights them */
/*        .binary-tree > li > .binary-node__children > li > .binary-node__content {
  border: 2px solid #FBBF24;
}*/
        .binary-tree, .binary-tree ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.binary-node {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.binary-node__content {
  background: #1F2937;
  color: #fff;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  margin: 0.5rem 0;
  min-width: 10rem;
  text-align: center;
}

/*this is what highlights them */
/*.binary-node.personal > .binary-node__content {
  border: 2px solid #FBBF24;
}*/

.binary-node__children {
  display: flex;
  flex-wrap: wrap;        /* allow multiple rows */
  justify-content: center;
  gap: 1rem;
  margin-top: 1rem;
  position: relative;
}

.binary-node__children::before {
  content: '';
  position: absolute;
  top: 0; left: 50%;
  height: 1rem;
  border-left: 2px solid #4B5563;
}

/* connectors for each child */
.binary-node__children > li::before {
  content: '';
  position: absolute;
  top: 0; left: 50%;
  width: 0; height: 0;
  border-top: 2px solid #4B5563;
}
.binary-node__children > li:first-child::before {
  left: 25%;
}
.binary-node__children > li:last-child::before {
  left: 75%;
}

</style>
</head>
<body class=" bg-gray-900 font-sans antialiased" onload="toggleVisibilityEdit();toggleVisibilityNew();">
    <x-banner />

    <div class="bg-gray-900 min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
