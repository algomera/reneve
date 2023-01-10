<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-[26px] font-bold mb-5">Nuovo Collaboratore</h1>

            <form action="{{Route('business.collaborator.store')}}" method="post" enctype="multipart/form-data" class="relative">
                @csrf
                <input hidden type="text" name="role" id="role" value="{{'collaborator'}}">

                <div class="w-full gap-5 justify-between flex">
                    {{-- DATI ANAGRAFICI --}}
                    <div class="w-1/2 border bg-white p-4 shadow-md">
                        <h3 class="text-[20px] font-bold mb-5 tracking-[0.75px]">Dati anagrafici</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="name" :value="__('Nome*')" />
                                <x-text-input id="name" class="block mt-1 w-full shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="last_name" :value="__('Cognome*')" />
                                <x-text-input id="last_name" class="block mt-1 w-full shadow-sm" type="text" name="last_name" :value="old('last_name')" required autofocus />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="date_of_birth" :value="__('Data di nascita')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" placeholder="01/01/2023" pattern="[0-9\./\]+" name="date_of_birth" :value="old('date_of_birth')" autofocus />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
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
                        </div>
                    </div>

                    {{-- RECAPITI --}}
                    <div class="w-1/2 border bg-white p-4 shadow-md">
                        <h3 class="text-[20px] font-bold mb-5 tracking-[0.75px]">Recapiti</h3>
                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="mobile_phone" :value="__('Cellulare*')" />
                                <x-text-input id="mobile_phone" class="block mt-1 w-full shadow-sm" type="text" name="mobile_phone" :value="old('mobile_phone')" required autofocus />
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
                                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="address" :value="__('Indirizzo*')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="civic" :value="__('Civico*')" />
                                <x-text-input id="civic" class="block mt-1 w-full" pattern="[0-9]+" type="number" name="civic" :value="old('civic')" required autofocus />
                                <x-input-error :messages="$errors->get('civic')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-3 mt-4">
                            <div class="grow">
                                <x-input-label for="city" :value="__('Città*')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="province" :value="__('Provincia*')" />
                                <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')" required autofocus />
                                <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            </div>
                            <div class="grow">
                                <x-input-label for="cap" :value="__('Cap*')" />
                                <x-text-input id="cap" class="block mt-1 w-full" pattern="[0-9]+" type="text" minlength="5" maxlength="5" name="cap" :value="old('cap')" required autofocus />
                                <x-input-error :messages="$errors->get('cap')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-[-60px] right-0 flex gap-3">
                    <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>

                    <button type="submit" class="px-7 py-3 bg-[#6EA0FF] text-[13px] font-bold uppercase text-white hover:bg-[#85AFFD] tracking-[0.75px]">Registra</button>
                </div>
            </form>

        </div>
    </div>
</x-business-layout>
