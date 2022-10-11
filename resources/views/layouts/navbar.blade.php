<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> 
<nav class="w-full bg-white border-gray-200 shadow fixed z-10 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="#" class="flex items-center">
            <img src="https://t4.ftcdn.net/jpg/04/96/47/13/360_F_496471319_DbtjoUvKqyy2e9OfgBnK5mm2AXhKpa9m.jpg" class="mr-3 h-6 sm:h-12" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-black">PhotoSale</span>
        </a>
        <div class="flex items-center lg:order-2">
            @if(!auth()->user())
            <a href="{{ route('login') }}" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a>
            <a href="{{ route('registrarFot') }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get started</a>
            @else
            <p class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">{{auth()->user()->name}}</p>
            <div x-data="{dropdownMenu: false}" class="lg:inline-block relative">
                        <!-- Dropdown toggle button -->
                        <button @click="dropdownMenu = ! dropdownMenu"
                            class="text-base hover:bg-green-300 hover:text-cool-gray-900 rounded-3xl  py-1 px-2 ">
                            <span class="sr-only">{{ auth()->user()->name }}</span>
                            <img class="h-10 w-10 rounded-full"
                                src="https://static.vecteezy.com/system/resources/previews/007/226/475/non_2x/user-account-circle-glyph-color-icon-user-profile-picture-userpic-silhouette-symbol-on-white-background-with-no-outline-negative-space-illustration-vector.jpg"
                                alt="avatar">
                        </button>
                        <!-- Dropdown list -->
                        <div x-show="dropdownMenu"
                            class="absolute right-0 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl w-44">
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                Mi Perfil
                            </a>
                            @if(auth()->user()->tipo == 'Organizador')
                            <a href="{{route('registrarEven')}}"
                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                Nuevo Evento
                            </a>
                            <a href="{{route('eventosOrganizador')}}"
                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                Mis Eventos
                            </a>
                            @else
                            <a href="{{route('eventosFotografo')}}"
                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                Mis Eventos
                            </a>
                            @endif
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
            @endif
            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{route('home')}}" class="text-gray-800 rounded hover:bg-green-600 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{route('dashOrg')}}" class="text-gray-800 rounded hover:bg-green-600 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Marketplace</a>
                </li>
                <li>
                    <a href="{{route('planes')}}" class="text-gray-800 rounded hover:bg-green-600 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Planes</a>
                </li>
                <li>
                    <a href="#" class="text-gray-800 rounded hover:bg-green-600 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Team</a>
            </ul>
        </div>
    </div>
</nav>