<x-admin-layout>
    <div class="pt-8">
        <div class="w-[90%] mx-auto overflow-hidden">
            <h1 class="text-[26px] font-bold mb-5">{{$business->business}}</h1>

            <div class="relative pb-[55px]">
                <form action="{{route('admin.business.update', $business)}}" method="post" enctype="multipart/form-data" class="flex gap-5 border-b pb-3 max-h-[750px]">
                    @csrf
                    @method('PUT')

                    <input hidden type="text" name="role" id="role" value="{{'business'}}">

                    {{-- Business Date --}}
                    <div class="w-3/5 bg-white p-5 shadow-sm">
                        <h3 class="text-[20px] font-bold mb-1">Azienda</h3>
                        <div class="flex gap-3">
                            <div class="flex flex-col gap-4 w-1/2 mt-4">
                                <div class="w-full">
                                    <x-input-label for="business" :value="__('Nome*')" />
                                    <x-text-input id="business" class="block mt-1 w-full" type="text" name="business" :value="old('business', $business->business)" required autofocus />
                                    <x-input-error :messages="$errors->get('business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="p_iva_business" :value="__('P.IVA*')" />
                                    <x-text-input id="p_iva_business" class="block mt-1 w-full" type="text" pattern="[0-9]+" minlength="11" maxlength="11" name="p_iva_business" :value="old('p_iva_business', $business->p_iva_business)" required autofocus />
                                    <x-input-error :messages="$errors->get('p_iva_business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="address_business" :value="__('Indirizzo e civico*')" />
                                    <x-text-input id="address_business" class="block mt-1 w-full" type="text" name="address_business" :value="old('address_business', $business->address_business)" required autofocus />
                                    <x-input-error :messages="$errors->get('address_business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="telephone_business" :value="__('Telefono')" />
                                    <x-text-input id="telephone_business" class="block mt-1 w-full" type="text" name="telephone_business" :value="old('telephone_business', $business->telephone_business)" autofocus  />
                                    <x-input-error :messages="$errors->get('telephone_business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="email_business" :value="__('Email*')" />
                                    <x-text-input id="email_business" class="block mt-1 w-full" type="email" name="email_business" :value="old('email_business', $business->email_business)" required autofocus />
                                    <x-input-error :messages="$errors->get('email_business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="type_business" :value="__('Tipo di Azienda*')" />
                                    <select name="type_business" id="type_business" name="type_business" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autofocus>
                                        <option disabled selected value="">{{$business->type_business}}</option>
                                        <option :value="old(centro estetico)">centro estetico</option>
                                    </select>
                                </div>
                                <div class="w-full">
                                    <x-input-label for="start_contract" :value="__('Inizio Contratto*')" />
                                    <x-text-input id="start_contract" class="block mt-1 w-full" type="date" name="start_contract" :value="old('start_contract', $business->start_contract)" required autofocus />
                                    <x-input-error :messages="$errors->get('start_contract')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex flex-col gap-4 w-1/2 mt-4">
                                <div class="w-full flex flex-col justify-between grow pt-[5px]">
                                    <span class="block font-extrabold uppercase text-[11px] text-[#ABB1B1] tracking-[.75px]">Logo</span>
                                    @if ($business->logo)
                                        <img id="load" src="{{asset('storage/' . $business->logo)}}" class="grow h-[125px] w-[126px] mb-[10px] border" alt="">
                                    @else
                                        <img id="load" src="{{ asset('images/logo-default.svg')}}" class="grow h-[125px] w-[126px] mb-[10px] border" alt="">
                                    @endif
                                    <label for="logo" class="w-[125px] h-[36px] py-2 px-6 bg-[#384255] text-white text-[12px] font-bold uppercase">CARICA FILE</label>
                                    <input id="logo" onchange="preview()" class="block mt-1 w-full opacity-0 z-[-1] absolute" type="file" name="logo" :value="old('logo')" />
                                    <span id="nameFile" class="block mt-1">Nessun file caricato al momento</span>
                                    <x-input-error :messages="$errors->get('Logo')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="mobile_phone_business" :value="__('Cellulare')" />
                                    <x-text-input id="mobile_phone_business" class="block mt-1 w-full" type="text" name="mobile_phone_business" :value="old('mobile_phone_business', $business->mobile_phone_business)" autofocus />
                                    <x-input-error :messages="$errors->get('mobile_phone_business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="pec_business" :value="__('Pec')" />
                                    <x-text-input id="pec_business" class="block mt-1 w-full" type="email" name="pec_business" :value="old('pec_business', $business->pec_business)" autofocus />
                                    <x-input-error :messages="$errors->get('pec_business')" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="discount" :value="__('Sconto Applicato')"/>
                                    <select name="discount" id="discount" name="discount" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"  autofocus>
                                        <option disabled selected value="">{{$business->discount}}%</option>
                                        <option {{$business->discount == '10' ? 'selected' : ''}} value="10">10%</option>
                                        <option {{$business->discount == '20' ? 'selected' : ''}} value="20">20%</option>
                                        <option {{$business->discount == '30' ? 'selected' : ''}} value="30">30%</option>
                                    </select>
                                </div>
                                <div class="w-full">
                                    <x-input-label for="end_contract" :value="__('Fine Contratto*')" />
                                    <x-text-input id="end_contract" class="block mt-1 w-full" type="date" name="end_contract" :value="old('end_contract', $business->end_contract)" required autofocus/>
                                    <x-input-error :messages="$errors->get('end_contract')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-2/5 flex flex-col gap-5">
                        {{-- User Date --}}
                        <div class="bg-white p-5 shadow-sm">
                            <h3 class="text-[20px] font-bold mb-5">Titolare/Legale rappresentante</h3>
                            <div class="flex gap-4">
                                <div class="w-1/2">
                                    <x-input-label for="name" :value="__('Nome*')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="w-1/2">
                                    <x-input-label for="name" :value="__('Cognome*')" />
                                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autofocus />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <div class="w-1/2">
                                    <x-input-label for="telephone" :value="__('Telefono')" />
                                    <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone', $user->telephone)" autofocus />
                                    <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                                </div>
                                <div class="w-1/2">
                                    <x-input-label for="mobile_phone" :value="__('Cellulare')" />
                                    <x-text-input id="mobile_phone" class="block mt-1 w-full" type="text" name="mobile_phone" :value="old('mobile_phone', $user->mobile_phone)" autofocus />
                                    <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email*')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email', $user->email)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Providers --}}
                        <div class="bg-white grow p-5 shadow-sm">
                            <h3 class="text-[20px] font-bold mb-3">Servizi Forniti</h3>
                            <div class="flex flex-col flex-wrap h-[150px] gap-5 overflow-y-auto p-2 pb-4">
                                @foreach ($providers as $pv )
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" id="{{'provider-'.$pv->id}}" name="providers[]" value="{{$pv->id}}" @if ($business->providers->contains($pv)) checked @endif autofocus">
                                        <x-input-label :for="$pv->id" :value="$pv->name" class="capitalize text-[15px] font-semibold" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-[0px] right-0 flex gap-3">
                        <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>

                        <button type="submit" class="px-7 py-3 bg-[#6EA0FF] text-[13px] font-bold uppercase text-white hover:bg-[#85AFFD] tracking-[0.75px]">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    function preview() {
        load.src = URL.createObjectURL(event.target.files[0]);
        var file = document.getElementById("logo").value;
        if (file) {
            document.querySelector("#nameFile").innerHTML ='';
            document.querySelector("#nameFile").innerHTML = file;
        }
        console.log(file);
    }
</script>

