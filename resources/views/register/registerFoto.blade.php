@extends('layouts.welcome-ecommerce-admin')

@section('content')
<div class="bg-gray-900 h-screen w-screen">
    <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
        <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
            <div class="flex flex-col w-full md:w-1/2 p-4">
                <div class="flex flex-col flex-1 justify-center mb-8">
                    <h1 class="text-4xl text-center font-thin">Subir Foto</h1>
                    <div class="w-full mt-4">
                        <form class="form-horizontal w-3/4 mx-auto" method="POST" action="{{route('saveFoto', [$id])}}" enctype="multipart/form-data">
                           @csrf
                           <div class="flex flex-col mt-4">
                                <input id="image" type="file" class="flex-grow h-8 px-2 border rounded border-grey-400" name="image" value="" required autofocus>
                            </div>
                            <div class="flex flex-col mt-8">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2 px-4 rounded">
                                   Subir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="hidden md:block md:w-1/2 rounded-r-lg" style="background: url('https://media.istockphoto.com/vectors/upload-image-flat-round-icons-vector-id842790842?k=20&m=842790842&s=612x612&w=0&h=rkqGlAj73qA8nTCK2J7bRmy0voJJEfEXJnBxuUu17oA='); background-size: cover; background-position: center center;"></div>
        </div>
    </div>
</div>
@endsection