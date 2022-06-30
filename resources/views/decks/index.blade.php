<x-app>
   
   <x-flash />

   <div class="flex justify-end pb-2">
      <a 
         href="{{route('decks.create')}}" 
         class="inline-block px-4 py-2 rounded-xl text-white bg-green-600 hover:bg-green-500 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            ADICIONAR
      </a>
   </div>

   @foreach($decks as $deck)
        <div class="bg-white border border-gray-300 mb-4 shadow-xl p-4 box-shadow" >
            <h2 class="text-xl w-full">{{$deck->name() }}</h3>
         </div>
   @endforeach

</x-app>