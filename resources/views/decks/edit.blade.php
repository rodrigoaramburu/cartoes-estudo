<x-app>
    <section class="px-16 mt-10">
        <h2 class="text-4xl text-bold mb-4">Alterar Baralho</h2>

        <x-flash message="Verifique os erros abaixo." />

        <form action="{{route('decks.update', $deck->name())}}" method="POST">
            @method('PUT')
            @csrf

            <input type="hidden" name="id" value="{{$deck->id()}}">
            <div class="mb-2">
                <label for="name" class="block mb-1">Nome do Baralho:</label>
                <input type="text" name="name" id="name" value="{{$deck->name()}}"  placeholder="Informe o nome do Baralho" class="w-full">
                @error('name')
                <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>
            
            <div class="flex gap-3 mb-2">
                <div class="w-full">
                    <label for="hard_interval_factor" class="block mb-1">Fator de Incremento Difícil:</label>
                    <input type="text" name="hard_interval_factor" id="hard_interval_factor" value="{{$deck->hardIntervalFactor()}}"  placeholder="Informe fator de incremento do status difícil" class="w-full">
                </div>
                <div  class="w-full">
                    <label for="normal_interval_factor" class="block mb-1">Fator de Incremento Difícil:</label>
                    <input type="text" name="normal_interval_factor" id="normal_interval_factor" value="{{$deck->normalIntervalFactor()}}"  placeholder="Informe fator de incremento do status normal" class="w-full">
                </div>
                <div class="w-full">
                    <label for="easy_interval_factor" class="block mb-1">Fator de Incremento Difícil:</label>
                    <input type="text" name="easy_interval_factor" id="easy_interval_factor" value="{{$deck->easyIntervalFactor()}}"  placeholder="Informe fator de incremento do status fácil" class="w-full">
                </div>
            </div>

            <button type="submit" class="flex items-center gap-1 bg-green-600 hover:bg-green-500 transition rounded-lg text-white  py-2 px-4 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Alterar
            </button>

        </form>
    </section>

</x-app>