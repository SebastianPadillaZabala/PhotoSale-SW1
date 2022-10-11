@extends('layouts.welcome-ecommerce-template')

@section('content')
<div class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-8 mx-auto">
        <h1 class="text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">Planes</h1>

        <p class="max-w-2xl mx-auto mt-4 text-2xl text-center text-gray-500 xl:mt-20 dark:text-gray-300">
            Nuestro catalogo de planes disponibles.
        </p>

        <div class="grid grid-cols-1 gap-8 mt-6 xl:mt-12 xl:gap-12 md:grid-cols-2 lg:grid-cols-2">
            @foreach($planes as $p)
            <div class="w-full p-8 space-y-8 text-center border border-gray-200 rounded-lg dark:border-gray-700">
                <p class="font-medium text-gray-500 uppercase dark:text-gray-300">Plan</p>
                <p class="font-medium text-gray-500 uppercase dark:text-gray-300">Para: {{$p->nombre_Plan}}</p>

                <h2 class="text-5xl font-bold text-gray-800 uppercase dark:text-gray-100">
                    ${{$p->Precio}}
                </h2>

                <p class="font-medium text-gray-500 dark:text-gray-300">{{$p->duracion}} dias</p>
                <p class="font-medium text-gray-500 dark:text-gray-300">{{$p->descripcion}}</p>
                <a href="{{route('check-out',[$p->id_Plan])}}">
                <button class="w-full px-4 py-2 mt-10 tracking-wide text-white capitalize transition-colors duration-300 transform bg-green-500 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700 focus:ring focus:ring-white focus:ring-opacity-80">
                    Adquirir
                </button>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection