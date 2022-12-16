<x-admin-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">Nuova Azienda</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <form action="{{Route('admin.business.store')}}" method="post" enctype="multipart/form-data" class="flex bg-white p-5 shadow-lg relative">
                @csrf
                <input hidden type="text" name="role" id="role" value="{{'business'}}">
                <div class="w-3/5 pr-5">
                    <h3 class="text-lg font-semibold mb-5">Azienda</h3>

                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="business" :value="__('Nome*')" />
                            <x-text-input id="business" class="block mt-1 w-full" type="text" name="business" :value="old('business')" required autofocus />
                            <x-input-error :messages="$errors->get('business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="logo" :value="__('Logo')" />
                            <input id="logo" class="block mt-1 w-full !bg-transparent" type="file" name="logo" :value="old('logo')" />
                            <x-input-error :messages="$errors->get('Logo')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="p_iva_business" :value="__('P.IVA*')" />
                            <x-text-input id="p_iva_business" class="block mt-1 w-full" type="text" pattern="[0-9]+" minlength="11" maxlength="11" name="p_iva_business" :value="old('p_iva_business')" required autofocus />
                            <x-input-error :messages="$errors->get('p_iva_business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="address_business" :value="__('Indirizzo e civico*')" />
                            <x-text-input id="address_business" class="block mt-1 w-full" type="text" name="address_business" :value="old('address_business')" required autofocus />
                            <x-input-error :messages="$errors->get('address_business')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="telephone_business" :value="__('Telefono')" />
                            <x-text-input id="telephone_business" class="block mt-1 w-full" type="text" name="telephone_business" :value="old('telephone_business')" autofocus  />
                            <x-input-error :messages="$errors->get('telephone_business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="mobile_phone_business" :value="__('Cellulare')" />
                            <x-text-input id="mobile_phone_business" class="block mt-1 w-full" type="text" name="mobile_phone_business" :value="old('mobile_phone_business')" autofocus />
                            <x-input-error :messages="$errors->get('mobile_phone_business')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="email_business" :value="__('Email*')" />
                            <x-text-input id="email_business" class="block mt-1 w-full" type="email" name="email_business" :value="old('email_business')" required autofocus />
                            <x-input-error :messages="$errors->get('email_business')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="pec_business" :value="__('Pec')" />
                            <x-text-input id="pec_business" class="block mt-1 w-full" type="email" name="pec_business" :value="old('pec_business')" autofocus />
                            <x-input-error :messages="$errors->get('pec_business')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="type_business" :value="__('Tipo di Azienda*')" />
                            <select name="type_business" id="type_business" name="type_business" autofocus>
                                <option disabled selected value="">Seleziona</option>
                                <option :value="old(centro estetico)">centro estetico</option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="discount" :value="__('Sconto Applicato')" autofocus/>
                            <select name="discount" id="discount" name="discount">
                                <option disabled selected value="">Seleziona</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="start_contract" :value="__('Inizio Contratto*')" />
                            <x-text-input id="start_contract" class="block mt-1 w-full" type="date" name="start_contract" :value="old('start_contract')" required autofocus />
                            <x-input-error :messages="$errors->get('start_contract')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="end_contract" :value="__('Fine Contratto*')" />
                            <x-text-input id="end_contract" class="block mt-1 w-full" type="date" name="end_contract" :value="old('end_contract')" required autofocus/>
                            <x-input-error :messages="$errors->get('end_contract')" class="mt-2" />
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mt-7 mb-5">Servizi associati</h3>

                    <div class="flex flex-col flex-wrap min-h-[350px] max-h-[350px] gap-5">
                        @foreach ($providers as $pv )
                            <div class="flex gap-3">
                                <input type="checkbox" id="{{'provider-'.$pv->id}}" name="providers[]" :value="old($pv->id)" autofocus">
                                <x-input-label :for="'provider-'.$pv->id" :value="$pv->name" class="font-bold capitalize" />
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- User Date --}}
                <div class="w-2/5 border-l pl-5">
                    <h3 class="text-lg font-semibold mb-5">Titolare/Legale rappresentante</h3>
                    <div class="flex gap-3">
                        <div class="w-1/2">
                            <x-input-label for="name" :value="__('Nome*')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="name" :value="__('Cognome*')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="telephone" :value="__('Telefono')" />
                            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" autofocus />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="mobile_phone" :value="__('Cellulare')" />
                            <x-text-input id="mobile_phone" class="block mt-1 w-full" type="text" name="mobile_phone" :value="old('mobile_phone')" autofocus />
                            <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email*')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="password" :value="__('Password*')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password')" autocomplete required autofocus/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="password_confirmation" :value="__('Conferma Password*')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="absolute bottom-5 right-5 border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[0.75px] ">Registra</button>
            </form>
        </div>
    </div>
</x-admin-layout>
