<nav x-data="{ open: false }" class="fixed transform xl:translate-x-0 ease-in-out transition duration-500 flex justify-start items-start h-full w-full sm:w-64 bg-gray-900/90 flex-col">

    {{-- AZIENDA --}}
    <div class="flex justify-center p-6 items-center space-x-3 w-full">
        <img src="{{ asset('images/logo_reneve.svg') }}" alt="">
    </div>

    {{-- UTENTE LOGGATO --}}
    <div class="mt-5 flex flex-col justify-start items-center gap-5 px-4 w-full border-gray-400 border-b-[2px] pb-5 ">
        <x-nav-link
            class="flex jusitfy-center items-center gap-4 space-x-5 p-3 w-full text-white rounded capitalize text-[18px] font-semibold"
            :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
        >
            <img class="w-5 h-5" src="{{ asset('images/icona_dashboard.svg') }}" alt="">
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-dropdown>
            <x-slot name="trigger">
                <button class="flex jusitfy-start items-center space-x-5 text-white font-medium ">
                    <img class="w-5 h-5" src="{{ asset('images/icona_admin.svg') }}" alt="">
                    <div class="capitalize text-[18px] font-semibold">{{auth()->user()->name }}</div>
                </button>
            </x-slot>

            <x-slot name="content">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                    >
                        <i class="fa-solid fa-right-from-bracket mt-[2px]"></i>
                        {{ __('Esci') }}
                    </x-dropdown-link>
                </form>
                <x-nav-link
                    class="flex jusitfy-center items-center gap-4 px-4 py-3 w-full hover:bg-gray-100"
                    href=""
                >
                    <i class="fa-solid fa-gears"></i>
                    {{ __('Profilo') }}
                </x-nav-link>
            </x-slot>
        </x-dropdown>
    </div>

    {{-- AZIENDE --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full ">
        <button onclick="dropdown1()" class="{{request()->routeIs('admin.business.*') ? 'text-[#6EA0FF] font-bold text-lg' : 'text-sm'}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Aziende</p>
            <i id="icon1" class="fa-solid fa-chevron-down {{request()->routeIs('admin.business.*') ? 'rotate-180': ''}}"></i>
        </button>

        <div id="menu1" class="{{request()->routeIs('admin.business.*') ? 'block': 'hidden'}} pb-3">
            <x-nav-link
                class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
                :href="route('admin.business.index')" :active="request()->routeIs('admin.business.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Lista') }}
            </x-nav-link>
            <x-nav-link
                class="uppercase text-[12px] font-bold flex jusitfy-center items-center gap-3 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 ml-4 !pb-0 !pt-1 mt-1"
                :href="route('admin.business.create')" :active="request()->routeIs('admin.business.create')"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('Aggiungi') }}
            </x-nav-link>
        </div>
    </div>

    {{-- DISPOSITIVI --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown2()" class="{{request()->routeIs('admin.service.*') ? 'text-[#6EA0FF] font-bold text-lg': 'text-sm'}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Dispositivi <br> Servizi</p>
            <i id="icon2" class="fa-solid fa-chevron-down {{request()->routeIs('admin.service.*') ? 'rotate-180': ''}}"></i>
        </button>

        <div id="menu2" class="{{request()->routeIs('admin.service.*') ? 'block': 'hidden'}} pb-3">
            <x-nav-link
                class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
                :href="route('admin.service.index')" :active="request()->routeIs('admin.service.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Lista') }}
            </x-nav-link>
            <x-nav-link
                class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 text-[12px] uppercase font-bold ml-4 !pb-0 !pt-1 mt-1"
                :href="route('admin.service.create')" :active="request()->routeIs('admin.service.create')"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('Aggiungi') }}
            </x-nav-link>
        </div>
    </div>

    {{-- ORDINI --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown3()" class="{{request()->routeIs('admin.order.*') ? 'text-[#6EA0FF] font-bold text-lg' : 'text-sm'}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Ordini</p>
            <i id="icon3" class="fa-solid fa-chevron-down {{request()->routeIs('admin.order.*') ? 'rotate-180': ''}}"></i>
        </button>

        <div id="menu3" class="{{request()->routeIs('admin.order.*') ? 'block': 'hidden'}} pb-3 w-full">
            <x-nav-link
            class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
            :href="route('admin.order.index')" :active="request()->routeIs('admin.order.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Lista') }}
            </x-nav-link>

            {{-- <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-regular fa-calendar"></i>
                <p class="text-base leading-4 tracking-[1px]">Calendario</p>
            </button> --}}
        </div>
    </div>

    {{-- MAGAZZINO --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full">
        <button onclick="dropdown4()" class="{{request()->routeIs('admin.warehouse.*') ? 'text-[#6EA0FF] font-bold text-lg' : 'text-sm'}} focus:outline-none focus:text-[#6EA0FF]  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Magazzino</p>
            <i id="icon4" class="fa-solid fa-chevron-down {{request()->routeIs('admin.warehouse.*') ? 'rotate-180': ''}}"></i>
        </button>

        <div id="menu4" class="{{request()->routeIs('admin.warehouse.*') ? 'block': 'hidden'}} pb-3">
            <x-nav-link
            class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
            :href="route('admin.warehouse.index')" :active="request()->routeIs('admin.warehouse.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Prodotti') }}
            </x-nav-link>
            <x-nav-link
            class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 uppercase text-[12px] font-bold ml-4 !pb-0 !pt-1 mt-1"
            :href="route('admin.warehouse.create')" :active="request()->routeIs('admin.warehouse.create')"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('Aggiungi') }}
            </x-nav-link>
        </div>
    </div>
</nav>

<script type="text/javascript">
function dropdown1() {
    document.querySelector("#menu1").classList.toggle("hidden");
    document.querySelector("#icon1").classList.toggle("rotate-180");
}
function dropdown2() {
    document.querySelector("#menu2").classList.toggle("hidden");
    document.querySelector("#icon2").classList.toggle("rotate-180");
}
function dropdown3() {
    document.querySelector("#menu3").classList.toggle("hidden");
    document.querySelector("#icon3").classList.toggle("rotate-180");
}
function dropdown4() {
    document.querySelector("#menu4").classList.toggle("hidden");
    document.querySelector("#icon4").classList.toggle("rotate-180");
}
</script>
