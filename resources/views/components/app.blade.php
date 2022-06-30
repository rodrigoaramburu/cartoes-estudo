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
    <body class="text-gray-900">
        <header class="bg-gray-800">
            <div class="container p-4 mx-auto text-white flex justify-between items-center">
                <h1 class="text-xl">Cartões de Estudo</h1>
                <nav>
                    <a 
                        href="{{route('decks.index')}}" 
                        class="inline-block px-4 py-2 rounded font-bold hover:bg-gray-600 {{ request()->route()->getName() == 'decks.index'? 'bg-gray-600': ''}}">
                        BARALHOS
                    </a>                
                                    
                </nav>
            </div>
        </header>
        <div class="container p-4 mx-auto">
            {{$slot}}
        </div>

    </body>
</html>
