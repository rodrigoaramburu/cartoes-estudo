<x-app :deck="$deck">

    <h2 class="text-4xl text-bold my-4">Cartões do Baralho: {{$deck->name()}}</h2>

    <x-flash />

    @if(!$cards->isEmpty())
        <table class="w-full">
            <tr class="bg-gray-800 text-white">
                <th class="p-1">Frente</th>
                <th class="p-1">Verso</th>
                <th class="p-1">Próxima Revisão</th>
                <th></th>
            </tr>
            @foreach($cards as $card)
                <tr class="even:bg-gray-100">
                    <td class="p-1">{{ strip_tags( str_replace('<', ' <', $card->front()))}}</td>
                    <td class="p-1">{{strip_tags( str_replace('<', ' <',$card->back()))}}</td>
                    <td class="p-1">{{$card->nextRevision()?->format('d/m/Y H:i') ?? '-'}}</td>
                    <td class="p-1">
                        <div class="flex gap-1 justify-end">
                            <a href="{{route('cards.edit', $card->id())}}" class="inline-block bg-gray-700 hover:bg-gray-600 transition rounded-lg p-2 text-white" title="Alterar Cartão">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{route('cards.delete', $card->id())}}" method="POST" onsubmit="return confirm('Você realmente deseja deletar o Cartão de Estudo')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-700 hover:bg-red-600 transition rounded-lg p-2 text-white" title="Deletar o Cartão de Estudo">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach()

        </table>
    @else
        <div class="text-center p-10">Nenhum cartão de estudo foi adicionado ainda. ☹</div>
    @endif

</x-app>