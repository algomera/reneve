<nav x-data="{ open: false }" class="fixed transform xl:translate-x-0 ease-in-out transition duration-500 flex justify-start items-start h-full w-full sm:w-64 bg-gray-900 flex-col">

    <div class="flex justify-center p-6 items-center space-x-3 w-full">
        <p class="text-4xl leading-6 text-white uppercase">
            Reneve
        </p>
    </div>

    <div class="mt-6 flex flex-col justify-start items-center gap-5 px-4 w-full border-gray-600 border-b pb-5 ">
        <x-nav-link
            class="flex jusitfy-center items-center gap-4 space-x-5 p-3 w-full text-white rounded "
            :href="route('dashboard')" :active="request()->routeIs('dashboard')"
        >
            <i class="fa-solid fa-house"></i>
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-dropdown>
            <x-slot name="trigger">
                <button class="flex jusitfy-start items-center space-x-5 text-white font-medium ">
                    <i class="fa-solid fa-user"></i>
                    <div>User {{auth()->user()->name }}</div>
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

    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown1()" class="focus:outline-none focus:text-indigo-400 text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="text-sm leading-5 uppercase">Clienti</p>
            <i id="icon1" class="fa-solid fa-chevron-up"></i>
        </button>

        <div id="menu1" class="hidden pb-3">
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-plus"></i>
                <p class="text-base leading-4 tracking-[1px]">Aggiungi</p>
            </button>
            <button class="flex justify-start items-center space-x-5 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-list"></i>
                <p class="text-base leading-4 tracking-[1px]">Lista</p>
            </button>
        </div>
    </div>

    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown2()" class="focus:outline-none focus:text-indigo-400 text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="text-sm leading-5 uppercase">Prenotazioni</p>
            <i id="icon2" class="fa-solid fa-chevron-up"></i>
        </button>

        <div id="menu2" class="hidden pb-3">
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-plus"></i>
                <p class="text-base leading-4 tracking-[1px]">Aggiungi</p>
            </button>
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-regular fa-calendar"></i>
                <p class="text-base leading-4 tracking-[1px]">Calendario</p>
            </button>
        </div>
    </div>

    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full  ">
        <button onclick="dropdown3()" class="focus:outline-none focus:text-indigo-400  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="text-sm leading-5 uppercase">Trattamenti</p>
            <i id="icon3" class="fa-solid fa-chevron-up"></i>
        </button>

        <div id="menu3" class="hidden pb-3">
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-plus"></i>
                <p class="text-base leading-4 tracking-[1px]">Aggiungi</p>
            </button>
            <button class="flex justify-start items-center space-x-5 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-list"></i>
                <p class="text-base leading-4 tracking-[1px]">Lista</p>
            </button>
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-percent"></i>
                <p class="text-base leading-4 tracking-[1px]">Promozioni</p>
            </button>
        </div>
    </div>

    <div class="flex flex-col justify-start items-center px-6 border-b border-gray-600 w-full">
        <button onclick="dropdown4()" class="focus:outline-none focus:text-indigo-400  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="text-sm leading-5 uppercase">Magazzino</p>
            <i id="icon4" class="fa-solid fa-chevron-up"></i>
        </button>

        <div id="menu4" class="hidden pb-3">
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-52">
                <i class="fa-solid fa-plus"></i>
                <p class="text-base leading-4 tracking-[1px]">Aggiungi</p>
            </button>
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-52">
                <i class="fa-solid fa-list"></i>
                <p class="text-base leading-4 tracking-[1px]">Prodotti</p>
            </button>
        </div>
    </div>

    <div class="flex flex-col justify-start items-center px-6 w-full  ">
        <button onclick="dropdown5()" class="focus:outline-none focus:text-indigo-400 text-left  text-white flex justify-between items-center w-full py-5 space-x-14  ">
            <p class="text-sm leading-5 uppercase">Collaboratori</p>
            <i id="icon5" class="fa-solid fa-chevron-up"></i>
        </button>

        <div id="menu5" class="hidden pb-3">
            <button class="flex justify-start items-center space-x-6 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-plus"></i>
                <p class="text-base leading-4 tracking-[1px]">Aggiungi</p>
            </button>
            <button class="flex justify-start items-center space-x-5 hover:text-white focus:bg-gray-700 focus:text-white hover:bg-gray-700 text-gray-400 rounded px-3 py-2  w-full md:w-52">
                <i class="fa-solid fa-list"></i>
                <p class="text-base leading-4 tracking-[1px]">Lista</p>
            </button>
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
function dropdown5() {
    document.querySelector("#menu5").classList.toggle("hidden");
    document.querySelector("#icon5").classList.toggle("rotate-180");
}
</script>
