<x-app>
    <section class="px-16 mt-10">
        <h2 class="text-4xl text-bold mb-4">Alterar Baralho</h2>

        <x-flash message="Verifique os erros abaixo." />

        <form action="{{route('decks.update', $deck->name())}}" method="POST">
            @method('PUT')
            @csrf

            <input type="hidden" name="id" value="{{$deck->id()}}">
            <div>
                <label for="name" class="block mb-1">Nome do Baralho:</label>
                <div class="flex gap-2 items-center">
                    <input type="text" name="name" id="name" value="{{$deck->name()}}"  placeholder="Informe o nome do Baralho" class="w-full">
                    <button type="submit" class="flex items-center gap-1 bg-green-600 hover:bg-green-500 transition rounded-lg text-white  py-2 px-4 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Alterar
                    </button>
                </div>
                @error('name')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>

        </form>
    </section>

</x-app>