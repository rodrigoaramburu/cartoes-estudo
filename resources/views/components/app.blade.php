<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cartões de Estudo</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-900  bg-gray-100">
        <header class="bg-gray-800">
            <div class="container p-4 mx-auto text-white flex justify-between items-center">
                <h1 class="text-xl">Cartões de Estudo</h1>
                <nav class="flex gap-2 items-center">
                    <a 
                        href="{{route('cards.create', ['deck'=> $deck?->id() ] ) }}" 
                        class="flex gap-1 items-center inline-block px-4 py-2 rounded font-bold hover:bg-gray-600 {{ request()->route()->getName() == 'cards.index'? 'bg-gray-600': ''}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            NOVO CARTÃO
                    </a>                
                    <a 
                        href="{{route('decks.index')}}" 
                        class="inline-block px-4 py-2 rounded font-bold hover:bg-gray-600 {{ request()->route()->getName() == 'decks.index'? 'bg-gray-600': ''}}">
                        BARALHOS
                    </a> 
                    
                    <form method="POST" action="{{route('decks.import')}}" enctype="multipart/form-data" x-data="{}" x-ref="form">
                        @csrf
                        <input type="file" name="deck-file" @change="$refs.form.submit()" x-ref="file" class="hidden">
                        <button type="button" @click="$refs.file.click()" class="flex gap-1 items-center inline-block px-4 py-2 rounded font-bold hover:bg-gray-600">
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="m17 9v-2h1c1.6569 0 3 1.3431 3 3v8c0 1.6569-1.3431 3-3 3h-12c-1.6569 0-3-1.3431-3-3v-8c0-1.6569 1.3431-3 3-3h1v2h-1c-0.55228 0-1 0.44772-1 1v8c0 0.55228 0.44772 1 1 1h12c0.55228 0 1-0.44772 1-1v-8c0-0.55228-0.44772-1-1-1h-1zm-3.9552 2.0473 1.1716-1.1577c0.40803-0.4032 1.0696-0.4032 1.4776 0 0.40803 0.4032 0.40803 1.0569 0 1.4601l-3.694 3.6503-3.694-3.6503c-0.40803-0.4032-0.40803-1.0569 0-1.4601 0.40803-0.4032 1.0696-0.4032 1.4776 0l1.1716 1.1577v-8.0148c0-0.57022 0.46778-1.0325 1.0448-1.0325s1.0448 0.46225 1.0448 1.0325v8.0148z" fill-rule="evenodd"/>
                            </svg>
                            Importar Baralho
                        </button>
                    </form>
                                    
                </nav>
            </div>
        </header>
        <div class="container p-4 mx-auto">
            {{$slot}}
        </div>

    </body>
</html>
