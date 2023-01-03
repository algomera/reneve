<x-admin-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">Servizio: {{$provider->name}}</h1>
                <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>
            </div>

            <div class="w-full bg-white shadow-lg p-5 mt-5 flex">
                <div class="w-full pr-5">

                    <div class="flex flex-col gap-1">
                        <span class="capitalize"><strong>Tipo Servizio:</strong> {{$provider->type}}</span>
                        <hr class="py-1">
                        <span><strong>Durata:</strong> {{$provider->duration}} Minuti</span>
                        <hr class="py-1">
                        <span><strong>Prezzo:</strong> € {{$provider->price}}</span>
                        <hr class="py-1">
                        <span><strong>Descrizione:</strong></span>
                        <p>{{$provider->description}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
