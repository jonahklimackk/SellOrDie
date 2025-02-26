<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <div>
                        <x-validation-errors />
                        <div>
                            <font color="red">{{ session('message') }}</font>
                            <font color="green">{{ session('success_message') }}</font>
                        </div>
                    </div>

                    <form method="POST" action="/mailing/store">
                      @csrf
                      <h1 class="mt-10">Enter Your Ad</h1>
                      <div class="mt-10 grid grid-cols-1 gap-6 space-between">
                          <x-label> Headline</x-label>
                          <x-input name="subject" placeholder="Your Subject Here" value=""/>
                          <x-label> Category </x-label>

                          <select name="category" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option>Select Category</option>
                            @foreach ($categories as $category)
                            <option> {{ $category->category }} </option>
                            @endforeach
                        </select>

                        <textarea name="body" rows="12" cols="65" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>

                        <x-label /> Url
                        <x-input name="url"  placeholder="Your Url Here" value=""/>

                        <div class="flex items-start">
                            <x-button class="mr-10">
                               Save New Mailing Ad
                           </x-button>
                           <input type="hidden" name="id" value="">
                       </form>



                   </div>
               </div>
           </form>
       </div>
   </div>
</div>
</div>
</x-app-layout>