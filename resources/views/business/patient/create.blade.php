<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">Nuovo Paziente</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <form action="{{Route('business.patient.store')}}" method="post" enctype="multipart/form-data" class="flex bg-white p-5 shadow-lg relative">
                @csrf
                <input hidden type="text" name="role" id="role" value="{{'patient'}}">

                <div class="w-1/2 pr-5">
                    {{-- DATI ANAGRAFICI --}}
                    <div class="border p-4 mb-4 shadow-md bg-gray-200/50">
                        <div class="flex justify-between">
                            <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Dati anagrafici</h3>
                            <div>
                                <x-input-label for="image_profile" :value="__('Foto Profilo')" />
                                <input id="image_profile" class=" opacity-50 rounded-md" type="file" name="image_profile" :value="old('image_profile')"  autofocus />
                                <x-input-error :messages="$errors->get('image_profile')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="name" :value="__('Nome*')" />
                                <x-text-input id="name" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="last_name" :value="__('Cognome*')" />
                                <x-text-input id="last_name" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="last_name" :value="old('last_name')" required autofocus />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="cf" :value="__('Cod. Fiscale')" />
                                <x-text-input id="cf" class="block mt-1 w-full" type="text" name="cf" :value="old('cf')" autofocus />
                                <x-input-error :messages="$errors->get('cf')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="date_of_birth" :value="__('Data di nascita')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" placeholder="01/01/2023" pattern="[0-9\./\]+" name="date_of_birth" :value="old('date_of_birth')" autofocus />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>
                            <div class="grow flex gap-2 items-center justify-center mt-5">
                                <x-text-input id="foreigner" type="checkbox" name="foreigner" :value="old('foreigner', 1)" autofocus />
                                <x-input-label for="foreigner" :value="__('Cliente straniero')" />
                                <x-input-error :messages="$errors->get('foreigner')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="birth_place" :value="__('Luogo di nascita')" />
                                <x-text-input id="birth_place" class="block mt-1 w-full" type="text" name="birth_place" :value="old('birth_place')" autofocus />
                                <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="country_of_birth" :value="__('Provincia')" />
                                <x-text-input id="country_of_birth" class="block mt-1 w-full" type="text" name="country_of_birth" :value="old('country_of_birth')" autofocus />
                                <x-input-error :messages="$errors->get('country_of_birth')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="mr-5">
                                <h6 class="font-semibold">Sesso</h6>
                                <div class="flex gap-5">
                                    <div class="grow flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('M')" />
                                        <x-text-input id="si" type="radio" name="sex" value="0"  autofocus />
                                        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                                    </div>
                                    <div class="grow flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('F')" />
                                        <x-text-input id="no" type="radio" name="sex" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="height" :value="__('Altezza (cm)')" />
                                <x-text-input id="height" class="block mt-1 w-full" pattern="[0-9]+" type="number" name="height" :value="old('height')" autofocus />
                                <x-input-error :messages="$errors->get('height')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="profession" :value="__('Professione')" />
                                <x-text-input id="profession" class="block mt-1 w-full" type="text" name="profession" :value="old('profession')" autofocus />
                                <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="business_name" :value="__('Ragione sociale')" />
                                <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="business_name" :value="old('business_name')" autofocus />
                                <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="p_iva" :value="__('P.IVA')" />
                                <x-text-input id="p_iva" class="block mt-1 w-full" pattern="[0-9]+" type="text" name="p_iva" :value="old('p_iva')" autofocus />
                                <x-input-error :messages="$errors->get('p_iva')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- RECAPITI --}}
                    <div class="border p-4 mb-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Recapiti</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="mobile_phone" :value="__('Cellulare*')" />
                                <x-text-input id="mobile_phone" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="mobile_phone" :value="old('mobile_phone')" autofocus />
                                <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="telephone" :value="__('Telefono')" />
                                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" autofocus />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="address" :value="__('Indirizzo')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autofocus />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="civic" :value="__('Civico')" />
                                <x-text-input id="civic" class="block mt-1 w-full" pattern="[0-9]+" type="number" name="civic" :value="old('civic')" autofocus />
                                <x-input-error :messages="$errors->get('civic')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="city" :value="__('Città')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autofocus />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="province" :value="__('Provincia')" />
                                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')" autofocus />
                                <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="cap" :value="__('Cap')" />
                                <x-text-input id="cap" class="block mt-1 w-full" pattern="[0-9]+" type="text" minlength="5" maxlength="5" name="cap" :value="old('cap')" autofocus />
                                <x-input-error :messages="$errors->get('cap')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- ALTRO --}}
                    <div class="mt-4 border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Altro</h3>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="knows" :value="__('Come ha conosciuto il centro?')" />
                                <x-text-input id="knows" class="block mt-1 w-full" type="text" name="knows" :value="old('knows')" autofocus />
                                <x-input-error :messages="$errors->get('knows')" class="mt-2" />
                            </div>
                        </div>

                        <x-input-label for="note" :value="__('Note')" />
                        <textarea id="note" name="note" cols="30" rows="5" class="block mt-1 w-full focus:border-current focus:ring-0" type="text" :value="old('note')" autofocus />
                        </textarea>
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>
                </div>

                <div class="w-1/2 border-l pl-5 flex flex-col">
                    {{-- STATO GENERALE DI SALUTE --}}
                    <div class="border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Stato generale di salute</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="allergies" :value="__('Allergie')" />
                                <x-text-input id="allergies" class="block mt-1 w-full" type="text" name="allergies" :value="old('allergies')" autofocus />
                                <x-input-error :messages="$errors->get('allergies')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="interventions" :value="__('Interventi recenti')" />
                                <x-text-input id="interventions" class="block mt-1 w-full" type="text" name="interventions" :value="old('interventions')" autofocus />
                                <x-input-error :messages="$errors->get('interventions')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="patologys" :value="__('Patologie')" />
                                <x-text-input id="patologys" class="block mt-1 w-full" type="text" name="patologys" :value="old('patologys')" autofocus />
                                <x-input-error :messages="$errors->get('patologys')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="medications" :value="__('Farmaci in assunzione')" />
                                <x-text-input id="medications" class="block mt-1 w-full" type="text" name="medications" :value="old('medications')" autofocus />
                                <x-input-error :messages="$errors->get('medications')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="disturbance" :value="__('Disturbi generali minori')" />
                            <x-text-input id="disturbance" class="block mt-1 w-full" type="text" name="disturbance" :value="old('disturbance')" required autofocus />
                            <x-input-error :messages="$errors->get('disturbance')" class="mt-2" />
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="mr-2 pr-3">
                                <h6 class="font-semibold">Artrosi e osteoporosi?</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="artrosi" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('artrosi')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="artrosi" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('artrosi')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="placche" :value="__('Placche/bulloni nel corpo?')" />
                                <x-text-input id="placche" class="block mt-1 w-full" type="text" name="placche" :value="old('placche')" autofocus />
                                <x-input-error :messages="$errors->get('placche')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="mr-2 pr-3">
                                <h6 class="font-semibold">Vaccinato COVID?</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="covid_vaccine" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('covid_vaccine')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="covid_vaccine" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('covid_vaccine')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="diseases" :value="__('Malattie negli ultimi 7 anni?')" />
                                <x-text-input id="diseases" class="block mt-1 w-full" type="text" name="diseases" :value="old('diseases')" autofocus />
                                <x-input-error :messages="$errors->get('diseases')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- STILE DI VITA --}}
                    <div class="mt-4 border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Stile di vita</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="mr-2 pr-3">
                                <h6 class="font-semibold">Pratica sport?</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="sport" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('sport')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="sport" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('sport')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="diuresi" :value="__('Diuresi')" />
                                <x-text-input id="diuresi" class="block mt-1 w-full" type="text" name="diuresi" :value="old('diuresi')" autofocus />
                                <x-input-error :messages="$errors->get('diuresi')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="diuresi_qta" :value="__('Qta. (l/gg)')" />
                                <x-text-input id="diuresi_qta" class="block mt-1 w-full" type="number" name="diuresi_qta" :value="old('diuresi_qta')" autofocus />
                                <x-input-error :messages="$errors->get('diuresi_qta')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Menopausa</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="menopause" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('menopause')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="menopause" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('menopause')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Ciclo irregolare</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="cicle" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('cicle')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="cicle" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('cicle')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Ass. anticoncezionali</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="contraceptive" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('contraceptive')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="contraceptive" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('contraceptive')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Fumatrice</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="smoker" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('smoker')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="smoker" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('smoker')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="pregnancy" class="font-semibold" :value="__('Stato di gravidanza (Mesi)')" />
                                <x-text-input id="pregnancy" class="block mt-1 w-full" placeholder="Nessuna" type="number" min="0" max="9" oninput="this.value = this.value > 9 ? 9 : Math.abs(this.value)" name="pregnancy" :value="old('pregnancy')" autofocus />
                                <x-input-error :messages="$errors->get('pregnancy')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="cellulite" :value="__('Cellulite')" />
                                <select name="cellulite" id="cellulite" name="cellulite" class="mt-1 w-full focus:border-current focus:ring-0">
                                    <option disabled selected value="">Seleziona</option>
                                    <option value="assente">Assente</option>
                                    <option value="edemmatosa">Edemmatosa</option>
                                    <option value="compatta">Compatta</option>
                                    <option value="molle">Molle</option>
                                    <option value="fibrosa">Fibrosa</option>
                                </select>
                                <x-input-error :messages="$errors->get('cellulite')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="intestine" :value="__('Intestino')" />
                                <select name="intestine" id="intestine" name="intestine" class="mt-1 w-full focus:border-current focus:ring-0">
                                    <option disabled selected value="">Seleziona</option>
                                    <option value="pigro">Pigro</option>
                                    <option value="regolare">Regolare</option>
                                    <option value="stipsi">Stipsi</option>
                                </select>
                                <x-input-error :messages="$errors->get('intestine')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- ALIMENTAZIONE --}}
                    <div class="mt-4 border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">alimentazione</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="mr-2 pr-3">
                                <h6 class="font-semibold">Tipo alimentazione</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Regolare')" />
                                        <x-text-input id="si" type="radio" name="alimentation" value="1" checked autofocus />
                                        <x-input-error :messages="$errors->get('alimentation')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('Irregolare')" />
                                        <x-text-input id="no" type="radio" name="alimentation" value="0"  autofocus />
                                        <x-input-error :messages="$errors->get('alimentation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="alimentation_note" :value="__('Note')" />
                                <textarea id="alimentation_note" name="alimentation_note" cols="30" rows="2" class="block mt-1 w-full focus:border-current focus:ring-0" type="text" :value="old('alimentation_note')" autofocus />
                                </textarea>
                                <x-input-error :messages="$errors->get('alimentation_note')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Segue piano alimentare</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <x-text-input id="si" type="radio" name="alimentation_follow" value="1"  autofocus />
                                        <x-input-error :messages="$errors->get('alimentation_follow')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <x-text-input id="no" type="radio" name="alimentation_follow" value="0" checked autofocus />
                                        <x-input-error :messages="$errors->get('alimentation_follow')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="alimentation_since" class="font-semibold" :value="__('Se si, da quando?')" />
                                <x-text-input id="alimentation_since" class="block mt-1 w-full" type="text" name="alimentation_since" :value="old('alimentation_since')" autofocus />
                                <x-input-error :messages="$errors->get('alimentation_since')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="drenant" class="font-semibold" :value="__('Assunzione drenanti')" />
                                <x-text-input id="drenant" class="block mt-1 w-full" type="text" name="drenant" :value="old('drenant')" autofocus />
                                <x-input-error :messages="$errors->get('drenant')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="integration" class="font-semibold" :value="__('Assunzione integratori')" />
                                <x-text-input id="integration" class="block mt-1 w-full" type="text" name="integration" :value="old('integration')" autofocus />
                                <x-input-error :messages="$errors->get('integration')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- ESTETICA --}}
                    <div class="mt-4 border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">estetica</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="flex gap-4 justify-start">
                                <div class="flex gap-2 items-center justify-center mt-2">
                                    <x-input-label for="si" :value="__('Estetica di base')" />
                                    <x-text-input id="si" type="radio" name="aesthetics" value="0" checked autofocus />
                                    <x-input-error :messages="$errors->get('aesthetics')" class="mt-2" />
                                </div>
                                <div class="flex gap-2 items-center justify-center mt-2">
                                    <x-input-label for="no" :value="__('Estetica avanzata')" />
                                    <x-text-input id="no" type="radio" name="aesthetics" value="1"  autofocus />
                                    <x-input-error :messages="$errors->get('aesthetics')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-8 mt-4">
                            <div class="flex gap-2 items-center justify-center mt-5">
                                <x-text-input id="adipe" type="checkbox" name="adipe" :value="old('adipe', 1)" autofocus />
                                <x-input-label for="adipe" :value="__('Adipe')" />
                                <x-input-error :messages="$errors->get('adipe')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 items-center justify-center mt-5">
                                <x-text-input id="skin_relax" type="checkbox" name="skin_relax" :value="old('skin_relax', 1)" autofocus />
                                <x-input-label for="skin_relax" :value="__('Rilassamento cutaneo')" />
                                <x-input-error :messages="$errors->get('skin_relax')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 items-center justify-center mt-5">
                                <x-text-input id="teleangectasia" type="checkbox" name="teleangectasia" :value="old('teleangectasia', 1)" autofocus />
                                <x-input-label for="teleangectasia" :value="__('Teleangectasia')" />
                                <x-input-error :messages="$errors->get('teleangectasia')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="body_cream" class="font-semibold" :value="__('Crema corpo')" />
                                <x-text-input id="body_cream" class="block mt-1 w-full" type="text" name="body_cream" :value="old('body_cream')" autofocus />
                                <x-input-error :messages="$errors->get('body_cream')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="face_cream" class="font-semibold" :value="__('Crema Viso')" />
                                <x-text-input id="face_cream" class="block mt-1 w-full" type="text" name="face_cream" :value="old('face_cream')" autofocus />
                                <x-input-error :messages="$errors->get('face_cream')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- PELLE --}}
                    <div class="mt-4 border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">pelle</h3>
                        <div class="flex gap-3 mt-4">
                            <div class=" min-w-[125px]">
                                <x-input-label for="skin" :value="__('Fototipo')" />
                                <select name="skin" id="skin" name="skin" class="mt-1 w-full focus:border-current focus:ring-0">
                                    <option disabled selected value="">Seleziona</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <x-input-error :messages="$errors->get('skin')" class="mt-2" />
                            </div>
                            <div class="flex gap-5 flex-wrap">
                                @foreach ($skin_type as $skin )
                                    <div class="flex gap-2 items-center justify-center">
                                        <x-text-input id="{{$skin}}" type="checkbox" name="skin_type[]" :value="old($skin)" autofocus />
                                        <x-input-label for="{{$skin}}" value="{{$skin}}" class="font-bold capitalize" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="skin_blemishes" class="font-semibold" :value="__('Inestetesmi viso')" />
                                <x-text-input id="skin_blemishes" class="block mt-1 w-full" type="text" name="skin_blemishes" :value="old('skin_blemishes')" autofocus />
                                <x-input-error :messages="$errors->get('skin_blemishes')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="body_blemishes" class="font-semibold" :value="__('Inestetismi corpo')" />
                                <x-text-input id="body_blemishes" class="block mt-1 w-full" type="text" name="body_blemishes" :value="old('body_blemishes')" autofocus />
                                <x-input-error :messages="$errors->get('body_blemishes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-5 mt-4">
                            <h3>Esp. Lampade solari</h3>
                            <div class="flex gap-2 items-center justify-center">
                                <x-text-input id="si" type="radio" name="solar_lamp" value="1" autofocus />
                                <x-input-label for="si" :value="__('Si')" />
                                <x-input-error :messages="$errors->get('solar_lamp')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 items-center justify-center">
                                <x-text-input id="no" type="radio" name="solar_lamp" value="0" checked autofocus />
                                <x-input-label for="no" :value="__('No')" />
                                <x-input-error :messages="$errors->get('solar_lamp')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-4 border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[1px] uppercase ">Registra</button>
                </div>
            </form>

        </div>
    </div>
</x-business-layout>
