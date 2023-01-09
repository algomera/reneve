<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">{{$user->name . ' ' . $user->last_name}}</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <form action="{{Route('business.patient.update', $user->id)}}" method="post" enctype="multipart/form-data" class="flex flex-col xl:flex-row bg-white p-5 shadow-lg relative">
                @csrf
                @method('PUT')

                <div class="w-full xl:w-1/2 xl:pr-5">
                    {{-- DATI ANAGRAFICI --}}
                    <div class="border p-4 mb-4 shadow-md bg-gray-200/50">
                        <div class="flex justify-between">
                            <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Dati anagrafici</h3>
                            @if ($user->image_profile)
                                <img class="w-[100px]" src="{{asset('storage/' . $user->image_profile)}}" alt="">
                            @endif

                            <div>
                                <x-input-label for="image_profile" :value="__('Cambia Foto')" />
                                <input id="image_profile" class=" opacity-50 rounded-md" type="file" name="image_profile" :value="old('image_profile', $user->image_profile)"  autofocus />
                                <x-input-error :messages="$errors->get('image_profile')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="name" :value="__('Nome*')" />
                                <x-text-input id="name" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="last_name" :value="__('Cognome*')" />
                                <x-text-input id="last_name" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autofocus />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="cf" :value="__('Cod. Fiscale')" />
                                <x-text-input id="cf" class="block mt-1 w-full" type="text" name="cf" :value="old('cf', $user->cf)" autofocus />
                                <x-input-error :messages="$errors->get('cf')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="date_of_birth" :value="__('Data di nascita')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" placeholder="01/01/2023" pattern="[0-9\./\]+" name="date_of_birth" :value="old('date_of_birth', $user->date_of_birth)" autofocus />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>
                            <div class="grow flex gap-2 items-center justify-center mt-5">
                                <input id="foreigner" type="checkbox" name="foreigner" value="1" @if ($user->foreigner == 1) checked @endif autofocus />
                                <x-input-label for="foreigner" :value="__('Cliente straniero')" />
                                <x-input-error :messages="$errors->get('foreigner')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="birth_place" :value="__('Luogo di nascita')" />
                                <x-text-input id="birth_place" class="block mt-1 w-full" type="text" name="birth_place" :value="old('birth_place', $user->birth_place)" autofocus />
                                <x-input-error :messages="$errors->get('birth_place')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="country_of_birth" :value="__('Provincia')" />
                                <x-text-input id="country_of_birth" class="block mt-1 w-full" type="text" name="country_of_birth" :value="old('country_of_birth', $user->country_of_birth)" autofocus />
                                <x-input-error :messages="$errors->get('country_of_birth')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="mr-5">
                                <h6 class="font-semibold">Sesso</h6>
                                <div class="flex gap-5">
                                    <div class="grow flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('M')" />
                                        <input id="si" type="radio" name="sex" value="0" @if ($user->sex == 0) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                                    </div>
                                    <div class="grow flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('F')" />
                                        <input id="no" type="radio" name="sex" value="1" @if ($user->sex == 1) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="height" :value="__('Altezza (cm)')" />
                                <x-text-input id="height" class="block mt-1 w-full" pattern="[0-9]+" type="number" name="height" :value="old('height', $user->height)" autofocus />
                                <x-input-error :messages="$errors->get('height')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="profession" :value="__('Professione')" />
                                <x-text-input id="profession" class="block mt-1 w-full" type="text" name="profession" :value="old('profession', $user->profession)" autofocus />
                                <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="business_name" :value="__('Ragione sociale')" />
                                <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="business_name" :value="old('business_name', $user->business_name)" autofocus />
                                <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="p_iva" :value="__('P.IVA')" />
                                <x-text-input id="p_iva" class="block mt-1 w-full" pattern="[0-9]+" type="text" name="p_iva" :value="old('p_iva', $user->p_iva)" autofocus />
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
                                <x-text-input id="mobile_phone" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="mobile_phone" :value="old('mobile_phone', $user->mobile_phone)" required autofocus />
                                <x-input-error :messages="$errors->get('mobile_phone')" class="mt-2" />
                            </div>

                            <div class="grow">
                                <x-input-label for="telephone" :value="__('Telefono')" />
                                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone', $user->telephone)" autofocus />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="email" :value="__('Email*')" />
                                <x-text-input id="email" class="block mt-1 w-full border-black/50 shadow-sm bg-slate-100" type="text" name="email" :value="old('email', $user->email)" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="address" :value="__('Indirizzo')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->address)" autofocus />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="civic" :value="__('Civico')" />
                                <x-text-input id="civic" class="block mt-1 w-full" pattern="[0-9]+" type="number" name="civic" :value="old('civic', $user->civic)" autofocus />
                                <x-input-error :messages="$errors->get('civic')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="city" :value="__('Città')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $user->city)" autofocus />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="province" :value="__('Provincia')" />
                                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province', $user->province)" autofocus />
                                <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="cap" :value="__('Cap')" />
                                <x-text-input id="cap" class="block mt-1 w-full" pattern="[0-9]+" type="text" minlength="5" maxlength="5" name="cap" :value="old('cap', $user->cap)" autofocus />
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
                                <x-text-input id="knows" class="block mt-1 w-full" type="text" name="knows" :value="old('knows', $user->knows)" autofocus />
                                <x-input-error :messages="$errors->get('knows')" class="mt-2" />
                            </div>
                        </div>

                        <x-input-label for="note" :value="__('Note')" />
                        <textarea id="note" name="note" cols="30" rows="5" class="block mt-1 w-full focus:border-current focus:ring-0" type="text" :value="old('note', $user->note)" autofocus />
                            {{$user->note}}
                        </textarea>
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>
                </div>

                <div class="w-full xl:w-1/2 xl:border-l xl:pl-5 mt-5 xl:mt-0 flex flex-col">
                    {{-- STATO GENERALE DI SALUTE --}}
                    <div class="border p-4 shadow-md bg-gray-200/50">
                        <h3 class="text-xl font-semibold mb-5 uppercase tracking-[0.75px]">Stato generale di salute</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="allergies" :value="__('Allergie')" />
                                <x-text-input id="allergies" class="block mt-1 w-full" type="text" name="allergies" :value="old('allergies', $user->allergies)" autofocus />
                                <x-input-error :messages="$errors->get('allergies')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="interventions" :value="__('Interventi recenti')" />
                                <x-text-input id="interventions" class="block mt-1 w-full" type="text" name="interventions" :value="old('interventions', $user->interventions)" autofocus />
                                <x-input-error :messages="$errors->get('interventions')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="patologys" :value="__('Patologie')" />
                                <x-text-input id="patologys" class="block mt-1 w-full" type="text" name="patologys" :value="old('patologys', $user->patologys)" autofocus />
                                <x-input-error :messages="$errors->get('patologys')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="medications" :value="__('Farmaci in assunzione')" />
                                <x-text-input id="medications" class="block mt-1 w-full" type="text" name="medications" :value="old('medications', $user->medications)" autofocus />
                                <x-input-error :messages="$errors->get('medications')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="disturbance" :value="__('Disturbi generali minori')" />
                            <x-text-input id="disturbance" class="block mt-1 w-full" type="text" name="disturbance" :value="old('disturbance', $user->disturbance)" autofocus />
                            <x-input-error :messages="$errors->get('disturbance')" class="mt-2" />
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="mr-2 pr-3">
                                <h6 class="font-semibold">Artrosi e osteoporosi?</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <input id="si" type="radio" name="artrosi" value="1" @if ($user->artrosi == 1) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('artrosi')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="artrosi" value="0" @if ($user->artrosi == 0) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('artrosi')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="placche" :value="__('Placche/bulloni nel corpo?')" />
                                <x-text-input id="placche" class="block mt-1 w-full" type="text" name="placche" :value="old('placche', $user->placche)" autofocus />
                                <x-input-error :messages="$errors->get('placche')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="mr-2 pr-3">
                                <h6 class="font-semibold">Vaccinato COVID?</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <input id="si" type="radio" name="covid_vaccine" value="1" @if ($user->covid_vaccine == 1 ) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('covid_vaccine')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="covid_vaccine" value="0" @if ($user->covid_vaccine == 0 ) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('covid_vaccine')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="diseases" :value="__('Malattie negli ultimi 7 anni?')" />
                                <x-text-input id="diseases" class="block mt-1 w-full" type="text" name="diseases" :value="old('diseases', $user->diseases)" autofocus />
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
                                        <input id="si" type="radio" name="sport" value="1" @if ($user->sport == 1 ) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('sport')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="sport" value="0" @if ($user->sport == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('sport')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="diuresi" :value="__('Diuresi')" />
                                <x-text-input id="diuresi" class="block mt-1 w-full" type="text" name="diuresi" :value="old('diuresi', $user->diuresi)" autofocus />
                                <x-input-error :messages="$errors->get('diuresi')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="diuresi_qta" :value="__('Qta. (l/gg)')" />
                                <x-text-input id="diuresi_qta" class="block mt-1 w-full" type="number" name="diuresi_qta" :value="old('diuresi_qta', $user->diuresi_qta)" autofocus />
                                <x-input-error :messages="$errors->get('diuresi_qta')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Menopausa</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <input id="si" type="radio" name="menopause" value="1" @if ($user->menopause == 1 ) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('menopause')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="menopause" value="0" @if ($user->menopause == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('menopause')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Ciclo irregolare</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <input id="si" type="radio" name="cicle" value="1" @if ($user->cicle == 1 ) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('cicle')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="cicle" value="0" @if ($user->cicle == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('cicle')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Ass. anticoncezionali</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <input id="si" type="radio" name="contraceptive" value="1" @if ($user->contraceptive == 1 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('contraceptive')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="contraceptive" value="0" @if ($user->contraceptive == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('contraceptive')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow mr-2 pr-3">
                                <h6 class="font-semibold">Fumatrice</h6>
                                <div class="flex gap-4 justify-start">
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="si" :value="__('Si')" />
                                        <input id="si" type="radio" name="smoker" value="1" @if ($user->smoker == 1 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('smoker')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="smoker" value="0" @if ($user->smoker == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('smoker')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="pregnancy" class="font-semibold" :value="__('Stato di gravidanza (Mesi)')" />
                                <x-text-input id="pregnancy" class="block mt-1 w-full" placeholder="Nessuna" type="number" min="0" max="9" oninput="this.value = this.value > 9 ? 9 : Math.abs(this.value)" name="pregnancy" :value="old('pregnancy', $user->pregnancy)" autofocus />
                                <x-input-error :messages="$errors->get('pregnancy')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="cellulite" :value="__('Cellulite')" />
                                <select name="cellulite" id="cellulite" name="cellulite" class="mt-1 w-full focus:border-current focus:ring-0">
                                    <option disabled selected value="">{{$user->cellulite}}</option>
                                    <option {{$user->cellulite == 'assente' ? 'selected' : ''}} value="assente">Assente</option>
                                    <option {{$user->cellulite == 'edemmatosa' ? 'selected' : ''}} value="edemmatosa">Edemmatosa</option>
                                    <option {{$user->cellulite == 'compatta' ? 'selected' : ''}} value="compatta">Compatta</option>
                                    <option {{$user->cellulite == 'molle' ? 'selected' : ''}} value="molle">Molle</option>
                                    <option {{$user->cellulite == 'fibrosa' ? 'selected' : ''}} value="fibrosa">Fibrosa</option>
                                </select>
                                <x-input-error :messages="$errors->get('cellulite')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="intestine" :value="__('Intestino')" />
                                <select name="intestine" id="intestine" name="intestine" class="mt-1 w-full focus:border-current focus:ring-0">
                                    <option disabled selected value="">{{$user->intestine}}</option>
                                    <option {{$user->intestine == 'pigro' ? 'selected' : ''}} value="pigro">Pigro</option>
                                    <option {{$user->intestine == 'regolare' ? 'selected' : ''}} value="regolare">Regolare</option>
                                    <option {{$user->intestine == 'stipsi' ? 'selected' : ''}} value="stipsi">Stipsi</option>
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
                                        <input id="si" type="radio" name="alimentation" value="1" @if ($user->alimentation == 1 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('alimentation')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('Irregolare')" />
                                        <input id="no" type="radio" name="alimentation" value="0" @if ($user->alimentation == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('alimentation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="grow">
                                <x-input-label for="alimentation_note" :value="__('Note')" />
                                <textarea id="alimentation_note" name="alimentation_note" cols="30" rows="2" class="block mt-1 w-full focus:border-current focus:ring-0" type="text" :value="old('alimentation_note')" autofocus />
                                    {{$user->alimentation_note}}
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
                                        <input id="si" type="radio" name="alimentation_follow" value="1" @if ($user->alimentation_follow == 1 ) checked @endif  autofocus />
                                        <x-input-error :messages="$errors->get('alimentation_follow')" class="mt-2" />
                                    </div>
                                    <div class="flex gap-2 items-center justify-center mt-2">
                                        <x-input-label for="no" :value="__('No')" />
                                        <input id="no" type="radio" name="alimentation_follow" value="0" @if ($user->alimentation_follow == 0 ) checked @endif autofocus />
                                        <x-input-error :messages="$errors->get('alimentation_follow')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="alimentation_since" class="font-semibold" :value="__('Se si, da quando?')" />
                                <x-text-input id="alimentation_since" class="block mt-1 w-full" type="text" name="alimentation_since" :value="old('alimentation_since', $user->alimentation_since)" autofocus />
                                <x-input-error :messages="$errors->get('alimentation_since')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="drenant" class="font-semibold" :value="__('Assunzione drenanti')" />
                                <x-text-input id="drenant" class="block mt-1 w-full" type="text" name="drenant" :value="old('drenant', $user->drenant)" autofocus />
                                <x-input-error :messages="$errors->get('drenant')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="integration" class="font-semibold" :value="__('Assunzione integratori')" />
                                <x-text-input id="integration" class="block mt-1 w-full" type="text" name="integration" :value="old('integration', $user->integration)" autofocus />
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
                                    <input id="si" type="radio" name="aesthetics" value="0" @if ($user->aesthetics == 0 ) checked @endif autofocus />
                                    <x-input-error :messages="$errors->get('aesthetics')" class="mt-2" />
                                </div>
                                <div class="flex gap-2 items-center justify-center mt-2">
                                    <x-input-label for="no" :value="__('Estetica avanzata')" />
                                    <input id="no" type="radio" name="aesthetics" value="1" @if ($user->aesthetics == 1 ) checked @endif autofocus />
                                    <x-input-error :messages="$errors->get('aesthetics')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-8 mt-4">
                            <div class="flex gap-2 items-center justify-center mt-5">
                                <input id="adipe" type="checkbox" name="adipe" value="1" @if ($user->adipe == 1 ) checked @endif autofocus />
                                <x-input-label for="adipe" :value="__('Adipe')" />
                                <x-input-error :messages="$errors->get('adipe')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 items-center justify-center mt-5">
                                <input id="skin_relax" type="checkbox" name="skin_relax" value="1" @if ($user->skin_relax == 1 ) checked @endif autofocus />
                                <x-input-label for="skin_relax" :value="__('Rilassamento cutaneo')" />
                                <x-input-error :messages="$errors->get('skin_relax')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 items-center justify-center mt-5">
                                <input id="teleangectasia" type="checkbox" name="teleangectasia" value="1" @if ($user->teleangectasia == 1 ) checked @endif autofocus />
                                <x-input-label for="teleangectasia" :value="__('Teleangectasia')" />
                                <x-input-error :messages="$errors->get('teleangectasia')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="body_cream" class="font-semibold" :value="__('Crema corpo')" />
                                <x-text-input id="body_cream" class="block mt-1 w-full" type="text" name="body_cream" :value="old('body_cream', $user->body_cream)" autofocus />
                                <x-input-error :messages="$errors->get('body_cream')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="face_cream" class="font-semibold" :value="__('Crema Viso')" />
                                <x-text-input id="face_cream" class="block mt-1 w-full" type="text" name="face_cream" :value="old('face_cream', $user->face_cream)" autofocus />
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
                                    <option disabled selected value="">{{$user->skin}}</option>
                                    <option {{$user->skin == '1' ? 'selected' : ''}} value="1">1</option>
                                    <option {{$user->skin == '2' ? 'selected' : ''}} value="2">2</option>
                                    <option {{$user->skin == '3' ? 'selected' : ''}} value="3">3</option>
                                    <option {{$user->skin == '4' ? 'selected' : ''}} value="4">4</option>
                                    <option {{$user->skin == '5' ? 'selected' : ''}} value="5">5</option>
                                </select>
                                <x-input-error :messages="$errors->get('skin')" class="mt-2" />
                            </div>
                            <div class="flex gap-5 flex-wrap">
                                @foreach ($skin_type as $skin )
                                    <div class="flex gap-2 items-center justify-center">
                                        <input id="{{$skin}}" type="checkbox" name="skin_type[]" value="{{$skin}}" @if (in_array($skin, $type)) checked @endif autofocus />
                                        <x-input-label for="{{$skin}}" value="{{$skin}}" class="font-bold capitalize" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="skin_blemishes" class="font-semibold" :value="__('Inestetesmi viso')" />
                                <x-text-input id="skin_blemishes" class="block mt-1 w-full" type="text" name="skin_blemishes" :value="old('skin_blemishes', $user->skin_blemishes)" autofocus />
                                <x-input-error :messages="$errors->get('skin_blemishes')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="body_blemishes" class="font-semibold" :value="__('Inestetismi corpo')" />
                                <x-text-input id="body_blemishes" class="block mt-1 w-full" type="text" name="body_blemishes" :value="old('body_blemishes', $user->body_blemishes)" autofocus />
                                <x-input-error :messages="$errors->get('body_blemishes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-5 mt-4">
                            <h3>Esp. Lampade solari</h3>
                            <div class="flex gap-2 items-center justify-center">
                                <input id="si" type="radio" name="solar_lamp" value="1" @if ($user->solar_lamp == 1 ) checked @endif autofocus />
                                <x-input-label for="si" :value="__('Si')" />
                                <x-input-error :messages="$errors->get('solar_lamp')" class="mt-2" />
                            </div>
                            <div class="flex gap-2 items-center justify-center">
                                <input id="no" type="radio" name="solar_lamp" value="0" @if ($user->solar_lamp == 0 ) checked @endif autofocus />
                                <x-input-label for="no" :value="__('No')" />
                                <x-input-error :messages="$errors->get('solar_lamp')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-4 border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[1px] uppercase ">Modifica</button>
                </div>
            </form>

        </div>
    </div>
</x-business-layout>
