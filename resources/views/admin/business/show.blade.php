<x-admin-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">{{$business->business}}</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <div class="w-full bg-white shadow-lg p-5 flex">
                <div class="w-1/2 pr-5">
                    <div class="flex justify-between">
                        <h3 class="text-xl font-bold mb-5 tracking-[0.5px]">Dati Aziendali</h3>
                        @if ($business->logo)
                            <img class="w-[100px] h-[100px] " src="{{asset('storage/' . $business->logo)}}" alt="">
                        @endif
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="capitalize"><strong>Tipo Azienda:</strong> {{$business->type_business}}</span>
                        <hr class="py-1">
                        <span><strong>P.IVA:</strong> {{$business->p_iva_business}}</span>
                        <hr class="py-1">
                        <span><strong>Indirizzo:</strong> {{$business->address_business}}</span>
                        <hr class="py-1">
                        <span><strong>Telefono:</strong> {{$business->telephone_business}}</span>
                        <hr class="py-1">
                        <span><strong>Cellulare:</strong> {{$business->mobile_phone_business}}</span>
                        <hr class="py-1">
                        <span><strong>Mail:</strong> {{$business->email_business}}</span>
                        <hr class="py-1">
                        <span><strong>PEC:</strong> {{$business->pec_business}}</span>
                        <hr class="py-1">
                        <div class="w-full flex justify-between">
                            <span class="w-1/2"><strong>Inizio Contratto:</strong> {{Str::replace('-', '/', $business->start_contract)}}</span>
                            <span class="w-1/2"><strong>Fine Contratto:</strong> {{Str::replace('-', '/', $business->end_contract)}}</span>
                        </div>
                        <hr class="py-1">
                        <span><strong>Sconto Applicato:</strong>
                        @if ($business->discount == null)
                            Nessun sconto inserito
                            @else
                            {{$business->discount}}%
                        @endif
                        </span>
                        <hr class="py-1">
                        <a href="{{route('admin.show_business', ['subdomain' => $business->subdomain])}}">
                            <strong>Dominio:</strong>
                            <span class="underline">{{$business->subdomain .'.'. env('APP_URL')}}</span>
                        </a>
                        <hr class="py-1">
                    </div>
                </div>

                <div class="w-1/2 border-l pl-5">
                    <h3 class="text-xl font-bold mb-6 capitalize tracking-[0.5px]">Utenti e Servizi</h3>
                    <span><strong>Titolare:</strong> {{$owner->last_name}} {{$owner->name}}</span>
                    <hr class="py-1 mb-3">

                    <strong>Servizi assegnati:</strong>
                    <div>
                        @if (count($providers) > 0)
                            <ol class="pl-5 flex flex-col flex-wrap max-h-[100px]">
                                @foreach ($providers as $pv )
                                    <li class="list-disc capitalize">
                                        {{$pv->name}}
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p class="underline">Nessun servizio assegnato!</p>
                        @endif
                    </div>
                    <hr class="py-1 mb-3">

                    <div>
                        <strong><i class="fa-solid fa-user mr-1"></i>Collaboratori:</strong>
                        @if (count($collaborators) > 0)
                            <ol class="pl-5">
                                @foreach ($collaborators as $cl )
                                    <li class="list-disc">
                                        {{$cl->name}} {{$cl->last_name}}
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p class="underline">Nessun Collaboratore presente al momento...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
