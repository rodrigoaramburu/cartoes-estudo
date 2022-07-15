<x-app :deck="$card?->deck()">

    
    <div class="flex flex-col justify-center items-center w-full h-full p-1" x-data="{flip: false}">
        
        @if($card)
            <h2 class="text-lg font-bold text-center mb-2">{{$card->deck()->name()}}</h2>

            <div class="w-[600px] h-[400px] group perspective mb-4">
                <div class="relative preserve-3d duration-1000 box-shadow  w-full h-full" :class="flip ? 'my-rotate-y-180':''">
                    <div class="absolute w-full h-full backface-hidden p-1">
                        <div class="border border-2 border-green-400 p-4 w-full h-full bg-white overflow-y-auto">
                            {!!$card->front()!!}
                        </div>
                    </div>
                    <div class="absolute my-rotate-y-180 w-full h-full backface-hidden p-1">
                        <div class="border border-2 border-green-400 p-4 w-full h-full bg-white overflow-y-auto">
                            {!!$card->back()!!}
                        </div>
                    </div>
                        
                </div>
            </div>

            <button @click="flip = true" :disabled="flip" class="flex gap-2 items-center bg-green-700 rounded-lg px-4 py-2 text-white disabled:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Ver Resposta
            </button>

            <form action="{{route('cards.nex-revision-store', $card->id())}}" method="POST" x-show="flip" class="flex gap-4 p-2 mt-2">
                @csrf
                <button name="revision-status" value="ERROR" class="flex gap-2 items-center bg-red-700 rounded-lg px-4 py-2 text-white disabled:bg-gray-400">
                    Errei
                </button>
                <button name="revision-status" value="HARD" class="flex gap-2 items-center bg-blue-700 rounded-lg px-4 py-2 text-white disabled:bg-gray-400">
                    Difícil
                </button>
                <button name="revision-status" value="NORMAL" class="flex gap-2 items-center bg-yellow-700 rounded-lg px-4 py-2 text-white disabled:bg-gray-400">
                    Médio
                </button>
                <button  name="revision-status" value="EASY" class="flex gap-2 items-center bg-green-700 rounded-lg px-4 py-2 text-white disabled:bg-gray-400">
                    Fácil
                </button>
            </form>

            <div class="p-3 text-center">
                <b>{{$totalCards}}</b> restantes
            </div>
        @else
            <div class="flex  flex-col gap-6 items-center justify-center">
                <p>Nenhum Cartão de Estudo para Revisar no momento!</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <a href="{{route('decks.index')}}" class="flex gap-2 items-center bg-gray-700 hover:bg-gray-500 transition rounded-lg px-4 py-2 text-white disabled:bg-gray-400">
                    Veja outros Baralhos
                </a>
            </div>
        @endif
    </div>

</x-app>