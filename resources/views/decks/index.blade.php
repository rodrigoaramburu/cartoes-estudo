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
        <div class="flex gap-2 bg-white border border-gray-300 mb-4 shadow-xl p-4 box-shadow" >
            <h2 class="text-xl w-full">{{$deck->name() }}</h3>

            <div>
               <form method="POST" action="{{route( 'decks.delete', $deck->id() )}}" onsubmit="return confirm('Você realmente deseja deletar o Baralho')">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="bg-red-700 hover:bg-red-600 transition rounded-lg p-2 text-white" title="Deletar o Baralho">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                     </svg>
                  </button>
               </form>
            </div>
         </div>
   @endforeach

</x-app>