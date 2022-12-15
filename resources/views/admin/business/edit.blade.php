<x-admin-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">{{$business->business}}</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            @if($errors->all())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif

            <form action="{{route('admin.business.update', $business)}}" method="POST" enctype="multipart/form-data" class="flex bg-white p-5 shadow-lg relative">
                @csrf
                @method('PUT')

                <div class="w-1/2 pr-5">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold mb-5">Azienda</h3>
                        @if ($business->logo)
                            <img class="w-[100px] h-[100px] " src="{{asset('storage/' . $business->logo)}}" alt="">
                        @endif
                    </div>


                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="business" :value="__('Nome*')" />
                            <x-text-input id="business" class="block mt-1 w-full" type="text" name="business" :value="old('business', $business->business)" required autofocus />
                            <x-input-error :messages="$errors->get('business')" class="mt-2" />
                        </div>
                        <div class="w-1/2 ">
                            <x-input-label for="logo" :value="__('Logo')" />
                            <x-text-input id="logo" class="block mt-2 w-full" type="file" name="logo" :value="old('logo', $business->logo)" />
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="p_iva_business" :value="__('P.IVA*')" />
                            <x-text-input id="p_iva_business" class="block mt-1 w-full" type="text" pattern="[0-9]+" minlength="11" maxlength="11" name="p_iva_business" :value="old('p_iva_business', $business->p_iva_business)" required autofocus />
                            <x-input-error :messages="$errors->get('p_iva_business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="address_business" :value="__('Indirizzo e civico*')" />
                            <x-text-input id="address_business" class="block mt-1 w-full" type="text" name="address_business" :value="old('address_business', $business->address_business)" required autofocus />
                            <x-input-error :messages="$errors->get('address_business')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="telephone_business" :value="__('Telefono')" />
                            <x-text-input id="telephone_business" class="block mt-1 w-full" type="text" name="telephone_business" :value="old('telephone_business', $business->telephone_business)" autofocus  />
                            <x-input-error :messages="$errors->get('telephone_business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="mobile_phone_business" :value="__('Cellulare')" />
                            <x-text-input id="mobile_phone_business" class="block mt-1 w-full" type="text" name="mobile_phone_business" :value="old('mobile_phone_business', $business->mobile_phone_business)" autofocus />
                            <x-input-error :messages="$errors->get('mobile_phone_business')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="email_business" :value="__('Email*')" />
                            <x-text-input id="email_business" class="block mt-1 w-full" type="text" name="email_business" :value="old('email_business', $business->email_business)" required autofocus />
                            <x-input-error :messages="$errors->get('email_business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="pec_business" :value="__('Pec')" />
                            <x-text-input id="pec_business" class="block mt-1 w-full" type="text" name="pec_business" :value="old('pec_business', $business->pec_business)" autofocus />
                            <x-input-error :messages="$errors->get('pec_business')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="type_business" :value="__('Tipo di Azienda*')" />
                            <select name="type_business" id="type_business" name="type_business" class="capitalize" autofocus>
                                <option disabled selected value="">{{$business->type_business}}</option>
                                <option {{$business->type_business == 'estetica' ? 'selected' : ''}} value="estetica">Estetica</option>
                                <option {{$business->type_business == 'farmacia' ? 'selected' : ''}} value="farmacia">Farmacia</option>
                                <option {{$business->type_business == 'centro avanzato' ? 'selected' : ''}} value="centro avanzato">Centro avanzato</option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="discount" :value="__('Sconto Applicato')" autofocus/>
                            <select name="discount" id="discount" name="discount">
                                <option disabled selected value="">{{$business->discount}}%</option>
                                <option {{$business->discount == '10' ? 'selected' : ''}} value="10">10%</option>
                                <option {{$business->discount == '20' ? 'selected' : ''}} value="20">20%</option>
                                <option {{$business->discount == '30' ? 'selected' : ''}} value="30">30%</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="start_contract" :value="__('Inizio Contratto*')" />
                            <x-text-input id="start_contract" class="block mt-1 w-full" type="date" name="start_contract" :value="old('start_contract', $business->start_contract)" required autofocus />
                            <x-input-error :messages="$errors->get('start_contract')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="end_contract" :value="__('Fine Contratto*')" />
                            <x-text-input id="end_contract" class="block mt-1 w-full" type="date" name="end_contract" :value="old('end_contract', $business->end_contract)" required autofocus/>
                            <x-input-error :messages="$errors->get('end_contract')" class="mt-2" />
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mt-7 mb-5">Servizi associati</h3>

                    <div class="flex flex-col flex-wrap min-h-[350px] max-h-[350px] gap-5">
                        @foreach ($providers as $pv )
                            <div class="flex gap-3">
                                <input type="checkbox" id="{{'provider-'.$pv->id}}" name="providers[]" value="{{$pv->id}}" @if ($business->providers->contains($pv)) checked @endif>
                                <x-input-label :for="$pv->id" :value="$pv->name" class="font-bold capitalize" />
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- User Date --}}
                <input hidden type="text" name="role" id="role" value="{{$user->role}}">

                <div class="w-1/2 border-l pl-5">
                    <h3 class="text-lg font-semibold mb-5">Titolare/Legale rappresentante</h3>
                    <div class="flex gap-3">
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

                <button type="submit" class="absolute bottom-5 right-5 border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[0.75px] ">Modifica</button>
            </form>

        </div>
    </div>
</x-admin-layout>
