<x-app>
    <section class="px-16 mt-10">
        <h2 class="text-4xl text-bold mb-4">Criar um Baralho</h2>

        <x-flash message="Verifique os erros abaixo." />

        <form action="{{route('decks.store')}}" method="POST">
            @csrf
            <div>
                <label for="name" class="block mb-1">Nome do Baralho:</label>
                <div class="flex gap-2 items-center">
                    <input type="text" name="name" id="name" value="{{old('name')}}"  placeholder="Informe o nome do Baralho" class="w-full">
                    <button type="submit" class="flex gap-1 bg-green-600 hover:green-500 transition rounded-lg text-white  py-2 px-4 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Adicionar
                    </button>
                </div>
                @error('name')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>

        </form>
    </section>

</x-app>