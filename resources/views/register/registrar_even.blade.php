@extends('layouts.welcome-ecommerce-admin')
@section('content')
<div class="bg-gray-900 h-screen w-screen">
    <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
        <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
            <div class="flex flex-col w-full md:w-1/2 p-4">
                <div class="flex flex-col flex-1 justify-center mb-8">
                    <h1 class="text-4xl text-center font-thin">Registrar Evento</h1>
                    <div class="w-full mt-4">
                        <form class="form-horizontal w-3/4 mx-auto" method="POST" action="{{route('registrarEvento')}}" enctype="multipart/form-data">
                           @csrf
                            <div class="flex flex-col mt-4">
                                <input id="name" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="name" value="" placeholder="Nombre del Evento" required autofocus>
                            </div>                         
                            <div class="flex flex-col mt-4">
                                <p class="font-semibold text-gray-400"></p>
                                <input id="fecha" type="date" class="flex-grow h-8 px-2 border rounded border-grey-400" name="fecha" value="" placeholder="fecha" required autofocus>
                            </div>
                            <div class="flex flex-col mt-4">
                                <input id="hora" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="hora" value="" placeholder="Hora" required autofocus>
                            </div>   
                            <div class="flex flex-col mt-4">
                                <input id="lugar" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="lugar" value="" placeholder="Direccion o Lugar" required autofocus>
                            </div>
                            <div class="flex flex-col mt-4">
                                <input id="tipo_evento" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="tipo_evento" value="" placeholder="Tipo de evento" required autofocus>
                            </div>    
                        <div class="input-group">
                             <label for="email" class="block mt-2 text-gray-600 font-semibold">Fotografo</label>
                             <select name="select">
                                <option value="">Selecciona un Fotografo</option>
                                @foreach ($fotografos as $f)
                                    <option value="<?= $f->id_fotografo ?>"><?= $f->name?></option>
                                @endforeach
                              </select>
                           <div class="input-group-append">
                          </div>
                     </div>
                            <div class="flex flex-col mt-8">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2 px-4 rounded">
                                    Registrar 
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="hidden md:block md:w-1/2 rounded-r-lg" style="background: url('https://definicion.de/wp-content/uploads/2009/09/concierto.jpg'); background-size: cover; background-position: center center;"></div>
        </div>
    </div>
</div>
@endsection