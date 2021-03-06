 <div class="">
     <div class="flex relative w-full max-w-xl mr-6 text-purple-500">
         <div class="absolute inset-y-0 flex items-center pl-2">
             <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                 <path fill-rule="evenodd"
                     d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                     clip-rule="evenodd"></path>
             </svg>
         </div>
         <input
             {{ $attributes->merge(['class' => 'w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-500 border-cool-gray-300 transition duration-150 ease-in-out rounded-md dark:placeholder-gray-500 dark:border-gray-700 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-800 dark:text-gray-200 focus:placeholder-gray-400 focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input']) }}
             type="search" aria-label="Search" />
     </div>
 </div>
