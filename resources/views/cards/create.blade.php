<x-app>
    <section class="px-16 mt-10">
        <h2 class="text-4xl text-bold mb-4">Criar um Cartão de Estudo</h2>

        <x-flash message="Verifique os erros abaixo." />

        <form method="POST" action="{{route('cards.store')}}">
            
            @csrf
            
            <div class="mt-2">
                <label for="deck_id" class="blcok">Baralho:</label>
                <select name="deck_id" id="deck_id" class="w-full">
                    @foreach($decks as $deck)
                        <option {{$deck->id == old('deck_id') || request()->input('deck') == $deck->id ? 'selected' : ''}} value="{{$deck->id}}">{{$deck->name}}</option>
                    @endforeach
                </select>
                @error('deck_id')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>

            <x-editor 
                name="front"
                label="Frente: "
            />
            <x-editor 
                name="back"
                label="Verso: "
            />
           

            <button type="submit" class="mt-4 flex gap-2 items-center rounded-lg px-4 py-2 bg-green-600 hover:bg-green-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Adicionar
            </button>
        </form>
        
    </section>
</x-app>