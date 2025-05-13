
<html>
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

<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.css" crossorigin>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/44.3.0/ckeditor5-premium-features.css" crossorigin>

<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />


<script src="https://cdn.tiny.cloud/1/hdpfz7m2vgiig2zohze2n23vfx0meivy7flc54tvj7biqkm3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<style>
  .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;


  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 520px;
    color: black;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    border:3px solid black;
    bottom: 100%;
    left: 50%;
    margin-left: -60px;
    background-color:white;
    opacity: 0;
    transition: opacity 1s;
        overflow-y: auto;
    max-height: 500px; 
  }

  .tooltip:hover .tooltiptext {

    visibility: visible;
    opacity: 1;
  }
</style>

</head>

<body style="text-align:center;">

  <h1>Tooltip Example</h1>
  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>
  <div class="tooltip">Hover over me
    <span class="tooltiptext" style="overflow-y:auto;">




      <a
      href="/fights/click/{{ $ad->url ?? ''}}" target="_blank"
      id="docs-card"
      class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10"
      >


      <div class="relative flex items-center gap-6 lg:items-center">
        <div class="mt-2" x-show="! photoPreview">
          <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full size-20 object-cover">
        </div>
        <div class="mt-2">
          <h1 class="text-5xl font-semibold text-black ">
            Headline
          </h1>
        </div>
      </div>
      <div class="mt-2">
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
        ajf;dksflj as;dkfjs;adk ljsa;f lsadj ;lskda j;lak jf
      </div>


    </a>  

  </span>
</div>
  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>  <br><br><br><br><br>
  <br><br><br><br><br>
  <br><br><br><br><br>
</body>
</html>