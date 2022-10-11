@extends('layouts.welcome-ecommerce-template')

@section('content')
<section class="min-h-screen flex justify-center items-center py-20">
    <div class="container px-6 py-10 mx-auto">
        <div class="text-center">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">Eventos</h1>
        </div>

        <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2 xl:grid-cols-3">
            @foreach($eventos as $e)
            <div class="transform hover:scale-105 transition duration-500 hover:bg-gray-50">
                <div class="relative">
                    <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80" src="https://cdn0.bodas.com.mx/vendor/4758/3_2/960/jpeg/salon-fiesta-colonial-redut-2-089_5_164758-158741239618002.jpeg" alt="">

                    <div class="absolute bottom-0 flex p-3 bg-white dark:bg-gray-900 ">
                        <img class="object-cover object-center w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80" alt="">

                        <div class="mx-4">
                            <h1 class="text-sm text-gray-700 dark:text-gray-200">{{$e->name}}</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{$e->tipo}}</p>
                        </div>
                    </div>
                </div>

                <h1 class="mt-6 text-xl font-semibold text-green-500 dark:text-white">
                    {{$e->nombre_evento}}
                </h1>

                <hr class="w-32 my-6 text-blue-500">

                <p class="text-sm text-gray-500 dark:text-gray-400">
                   Fecha: {{$e->fecha}} - Hora: {{$e->hora}} - Lugar: {{$e->lugar}}
                </p>

                <a href="#" class="inline-block mt-4 text-blue-500 underline hover:text-blue-400">Read more</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection