<nav x-data="{ open: false }" class="fixed transform xl:translate-x-0 ease-in-out transition duration-500 flex justify-start items-start h-full w-full sm:w-64 bg-[#272E3B] flex-col">

    {{-- AZIENDA --}}
    <div class="flex justify-center p-6 items-center space-x-3 w-full">
        <p class="text-4xl leading-8 tracking-[0.75px] text-white uppercase">
           {{auth()->user()->business->first()->business}}
        </p>
    </div>

    {{-- UTENTE LOGGATO --}}
    <div class="mt-5 flex flex-col justify-start items-center gap-5 px-4 w-full border-gray-400 border-b-[2px] pb-5 ">
        <x-nav-link
            class="flex jusitfy-center items-center gap-4 space-x-5 p-3 w-full text-white rounded capitalize text-[18px] font-semibold"
            :href="route('business.dashboard')" :active="request()->routeIs('business.dashboard')"
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

    {{-- PAZIENTI --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown1()" class="{{request()->routeIs('business.patient.*') ? 'text-[#6EA0FF]' : ''}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Pazienti</p>
            <i id="icon1" class="fa-solid fa-chevron-down {{request()->routeIs('business.patient.*') ? 'rotate-180': ''}}"></i>
        </button>

        <div id="menu1" class="{{request()->routeIs('business.patient.*') ? 'block': 'hidden'}} pb-3">
            <x-nav-link
            class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
            :href="route('business.patient.index')" :active="request()->routeIs('business.patient.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Lista') }}
            </x-nav-link>
            <x-nav-link
                class="uppercase text-[12px] font-bold flex jusitfy-center items-center gap-3 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 ml-4 !pb-0 !pt-1 mt-1"
                :href="route('business.patient.create')" :active="request()->routeIs('business.patient.create')"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('Aggiungi') }}
            </x-nav-link>
        </div>
    </div>

    {{-- PRENOTAZIONI --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button class="{{request()->routeIs('business.calendar') ? 'text-[#6EA0FF]' : ''}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 ">
            <x-nav-link
            class="flex justify-between items-center gap-5 space-x-5 w-full rounded capitalize text-[18px] font-semibold"
            :href="route('business.calendar')"
            >
                {{ __('Prenotazioni') }}
                <i class="fa-regular fa-calendar"></i>
            </x-nav-link>
        </button>
    </div>

    {{-- TRATTAMENTI --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown3()" class="{{request()->routeIs('business.provider.*') ? 'text-[#6EA0FF]' : ''}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Trattamenti</p>
            <i id="icon3" class="fa-solid fa-chevron-down"></i>
        </button>

        <div id="menu3" class="{{request()->routeIs('business.provider.*') ? 'block': 'hidden'}} pb-3">
            <x-nav-link
                class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
                :href="route('business.provider.index')" :active="request()->routeIs('business.provider.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Lista') }}
            </x-nav-link>
            <x-nav-link
                class="uppercase text-[12px] font-bold flex jusitfy-center items-center gap-3 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 ml-4 !pb-0 !pt-1 mt-1"
                :href="route('business.provider.create')" :active="request()->routeIs('business.provider.create')"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('Aggiungi') }}
            </x-nav-link>
            <x-nav-link
                class="mt-2 flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
                :href="route('business.patient.index')" :active="request()->routeIs('')"
            >
                <i class="fa-solid fa-percent"></i>
                {{ __('Promozioni') }}
            </x-nav-link>
        </div>
    </div>

    {{-- MAGAZZINO --}}
    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full">
        <button onclick="dropdown4()" class="{{request()->routeIs('business.warehouse.*') ? 'text-[#6EA0FF]' : ''}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5 ">
            <p class="leading-5 capitalize text-[18px] font-semibold">Magazzino</p>
            <i id="icon4" class="fa-solid fa-chevron-down"></i>
        </button>

        <div id="menu4" class="{{request()->routeIs('business.warehouse.*') ? 'block': 'hidden'}} pb-3">
            <x-nav-link
            class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
            :href="route('business.warehouse.index')" :active="request()->routeIs('business.warehouse.index')"
            >
                <i class="fa-solid fa-list"></i>
                {{ __('Prodotti') }}
            </x-nav-link>
            <x-nav-link
                class="uppercase text-[12px] font-bold flex jusitfy-center items-center gap-3 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 ml-4 !pb-0 !pt-1 mt-1"
                :href="route('business.warehouse.create')" :active="request()->routeIs('business.warehouse.create')"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('Aggiungi') }}
            </x-nav-link>
        </div>
    </div>

    {{-- COLLABORATORI/CABINE --}}
    <div class="flex flex-col justify-start items-center px-6 w-full  ">
        <button onclick="dropdown5()" class="{{request()->routeIs('business.collaborator.*') ? 'text-[#6EA0FF]' : ''}} {{request()->routeIs('business.cabin.*') ? 'text-[#6EA0FF]' : ''}} focus:outline-none focus:text-[#6EA0FF] text-left  text-white flex justify-between items-center w-full py-5">
            <p class="leading-5 capitalize text-[18px] font-semibold">Collaboratori/Cabine</p>
            <i id="icon5" class="fa-solid fa-chevron-down"></i>
        </button>

        <div id="menu5" class="{{request()->routeIs('business.collaborator.*') ? '!block': ''}} {{request()->routeIs('business.cabin.*') ? '!block': ''}} hidden pb-3">
            <div>
                <x-nav-link
                class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
                :href="route('business.collaborator.index')" :active="request()->routeIs('business.collaborator.index')"
                >
                    <i class="fa-solid fa-list"></i>
                    {{ __('Lista Collaboratori') }}
                </x-nav-link>
                <x-nav-link
                    class="uppercase text-[12px] font-bold flex jusitfy-center items-center gap-3 space-x-5 p-3 w-[55%] rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 ml-4 !pb-0 !pt-1 mt-1"
                    :href="route('business.collaborator.create')" :active="request()->routeIs('business.collaborator.create')"
                >
                    <i class="fa-solid fa-plus"></i>
                    {{ __('Aggiungi') }}
                </x-nav-link>
            </div>
            <div class="mt-2">
                <x-nav-link
                class="flex jusitfy-center items-center gap-5 space-x-5 p-3 w-full rounded hover:text-white focus:bg-gray-700 text-gray-400 focus:text-white hover:bg-gray-700 !py-2"
                :href="route('business.cabin.index')" :active="request()->routeIs('business.cabin.*')"
                >
                    <i class="fa-solid fa-list"></i>
                    {{ __('Cabine') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</nav>

<script type="text/javascript">
    function dropdown1() {
        document.querySelector("#menu1").classList.toggle("hidden");
        document.querySelector("#icon1").classList.toggle("rotate-180");
    }
    function dropdown3() {
        document.querySelector("#menu3").classList.toggle("hidden");
        document.querySelector("#icon3").classList.toggle("rotate-180");
    }
    function dropdown4() {
        document.querySelector("#menu4").classList.toggle("hidden");
        document.querySelector("#icon4").classList.toggle("rotate-180");
    }
    function dropdown5() {
        document.querySelector("#menu5").classList.toggle("hidden");
        document.querySelector("#icon5").classList.toggle("rotate-180");
    }
</script>
