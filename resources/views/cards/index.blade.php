<x-app :deck="$deck">

    <h2 class="text-4xl text-bold my-4">Cartões do Baralho: {{$deck->name}} ({{$cards->count()}} cartões)</h2>

    <x-flash />


    <div class="flex justify-end mb-2">
        <a href="{{route('cards.next-revision', $deck->id)}}" class="flex gap-2 inline-block bg-green-700 hover:bg-green-600 transition rounded-lg p-2 text-white" title="Revisar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Revisar Baralho
        </a>
    </div>

    @if(!$cards->isEmpty())
        @foreach($cards as $card)
            <div class="bg-white rounded-2xl shadow-lg flex items-center gap-2 mb-4 p-4">
                <div class="p-1 w-full border-r-2">
                    {{ strip_tags( $card->frontHtml) }}
                </div>
                <div class="p-1 w-full border-r-2">
                    {{strip_tags( $card->backHtml) }}
                </div>
                <div class="p-1 border-r-2 w-full">
                    {{$card->nextRevision?->format('d/m/Y H:i') ?? '-'}}
                </div>
                <div class="p-1">
                    <div class="flex gap-1 justify-end">
                        <a href="{{route('cards.edit', $card->id)}}" class="inline-block bg-gray-700 hover:bg-gray-600 transition rounded-lg p-2 text-white" title="Alterar Cartão">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>
                        <form action="{{route('cards.delete', $card->id)}}" method="POST" onsubmit="return confirm('Você realmente deseja deletar o Cartão de Estudo')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 hover:bg-red-600 transition rounded-lg p-2 text-white" title="Deletar o Cartão de Estudo">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach()
    @else
        <div class="text-center p-10">Nenhum cartão de estudo foi adicionado ainda. ☹</div>
    @endif

</x-app>