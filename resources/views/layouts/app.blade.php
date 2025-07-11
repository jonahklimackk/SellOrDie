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
