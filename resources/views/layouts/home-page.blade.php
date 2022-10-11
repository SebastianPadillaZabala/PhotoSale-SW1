<!-- component -->
<div class="w-full">
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <div class="flex bg-white" style="height:835px;">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div>
                <h2 class="text-3xl font-semibold text-gray-800 md:text-4xl">E-commerce de Fotografias <span class="text-green-500">Digitales</span></h2>
                <p class="mt-2 text-sm text-gray-500 md:text-base">La mejor manera para que los fotógrafos modernos compartan, entreguen, prueben y vendan en línea.!</p>
                <div class="flex justify-center lg:justify-start mt-6">
                    <a class="px-4 py-3 bg-green-500 text-white text-xl font-semibold rounded hover:bg-green-600" href="{{ route('registrarFot')}}">Trabaja con nosotros!</a>
                    <a class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xl font-semibold rounded hover:bg-gray-400" href="{{route('registrarOrg')}}">Registra tu evento</a>
                </div>
            </div>
        </div>
        <div class="hidden lg:block lg:w-2/3" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover" style="background-image: url(https://i.pinimg.com/564x/39/54/cc/3954cc9e91086b1f55232bb5f486d45d.jpg)">
                <div class="h-full bg-black opacity-25"></div>
            </div>
        </div>
    </div>
</div>