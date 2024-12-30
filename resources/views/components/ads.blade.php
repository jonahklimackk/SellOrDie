

<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

  <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
    Welcome to Your Ads
 </h1>

 <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
    If you want to make your name as the best Fighter in the sellordie league, you gotta
    have an ad. Be sure that it packs the 1-2 punch to destroy your opponents!
 </p>

<p>
@foreach($errors->all() as $error)
{{ $error }}
@endforeach



<form method="POST" action="/ads/create">
  @csrf

  <div class="grid grid-cols-1 gap-6 space-between">
    <x-label> Headline</x-label>
    <x-input name="headline" placeholder="Your Headline Here" />

    <textarea name="body" rows="12" cols="65" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">Enter Your Ad Here - Use The HTML wysiwyg </textarea>

    <x-label /> My label
    <x-input name="url"  placeholder="Your Url Here" />

    <x-button>
       Submit Your Ad
    </x-button>
 </div>
</form>

</div>
