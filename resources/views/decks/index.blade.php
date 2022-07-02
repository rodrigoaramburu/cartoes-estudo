<x-app>
   
   <x-flash />

   <div class="flex justify-end pb-2">
      <a 
         href="{{route('decks.create')}}" 
         class="inline-block px-4 py-2 rounded-xl text-white bg-green-600 hover:bg-green-500 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            NOVO BARALHO
      </a>
   </div>

   @foreach($decks as $deck)
        <div class="flex gap-2 bg-white border border-gray-300 mb-4 shadow-xl p-4 box-shadow" >
            <h2 class="text-xl w-full">{{$deck->name() }}</h3>

            <div class="flex gap-2 items-center">
               <a href="{{route('cards.index', $deck->id())}}" class="inline-block bg-gray-700 hover:bg-gray-600 transition rounded-lg p-2 text-white" title="Visualizar Cartões do Baralho">
                  <svg class="text-white bg-gray-700" width="24" height="24" version="1.1" viewBox="0 0 6.35 6.35" xmlns="http://www.w3.org/2000/svg"><g stroke="currentColor"><rect x="1.0329" y="1.7623" width="4.9657" height="3.4451" ry=".75307" fill="none" stroke-width=".30924"/><rect x=".52867" y=".99362" width="4.9657" height="3.4451" ry=".75307" fill="#374151" stroke-width=".30924"/><g transform="translate(.026836)" fill="none" stroke-width=".26458px"><path d="m1.0061 1.7623 3.2947-0.0097784"/><path d="m1.0014 2.5394h2.6824"/><path d="m1.0014 3.4335h3.0401"/></g></g></svg>
               </a>
               <a href="{{route('decks.edit', $deck->id())}}" class="inline-block bg-gray-700 hover:bg-gray-600 transition rounded-lg p-2 text-white" title="Editar o Baralho">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
               </a>
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