<x-app>

    <h2 class="text-4xl text-bold my-4">Cartões do Baralho: {{$deck->name()}}</h2>

    <x-flash />

    @if(!$cards->isEmpty())
        <table class="w-full">
            <tr class="bg-gray-800 text-white">
                <th class="p-1">Frente</th>
                <th class="p-1">Atrás</th>
                <th class="p-1">Próxima Revisão</th>
            </tr>
            @foreach($cards as $card)
                <tr class="even:bg-gray-100">
                    <td class="p-1">{{$card->front()}}</td>
                    <td class="p-1">{{$card->back()}}</td>
                    <td class="p-1">{{$card->nextRevision()?->format('d/m/Y h:i')}}</td>
                </tr>
            @endforeach()

        </table>
    @else
        <div class="text-center p-10">Nenhum cartão de estudo foi adicionado ainda. ☹</div>
    @endif

</x-app>