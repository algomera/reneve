<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">Nuova Prenotazione</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <form action="{{Route('business.reservation.store')}}" method="post" class="bg-white p-5 shadow-lg relative">
                @csrf

                <div class="w-full flex gap-2">
                    <div class="grow">
                        <x-input-label for="user_id" :value="__('Paziente')" />
                        <select name="user_id" id="user_id" name="user_id" class="mt-1 w-full focus:border-current focus:ring-0">
                            <option disabled selected value="">Seleziona</option>
                            @foreach ($patients as $patient )
                                <option value="{{$patient->id}}">{{$patient->name . ' ' . $patient->last_name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <div class="grow">
                        <x-input-label for="cabin_id" :value="__('Cabina')" />
                        <select name="cabin_id" id="cabin_id" name="cabin_id" class="mt-1 w-full focus:border-current focus:ring-0">
                            <option disabled selected value="">Seleziona</option>
                            @foreach ($cabins as $cabin )
                                <option value="{{$cabin->id}}">{{$cabin->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('cabin_id')" class="mt-2" />
                    </div>

                    <div class="grow">
                        <x-input-label for="provider_id" :value="__('Servizio')" />
                        <select name="provider_id" id="provider_id" name="provider_id" class="mt-1 w-full focus:border-current focus:ring-0">
                            <option disabled selected value="">Seleziona</option>
                            @foreach ($providers as $provider )
                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('provider_id')" class="mt-2" />
                    </div>

                    <div class="grow">
                        <x-input-label for="start_time" :value="__('inizio')" />
                        <x-text-input id="start_time" class="block mt-1 w-full" type="datetime-local" placeholder="01/01/2023" pattern="[0-9\./\]+" name="start_time" :value="old('start_time')" autofocus />
                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    </div>
                    <div class="grow">
                        <x-input-label for="finish_time" :value="__('fine')" />
                        <x-text-input id="finish_time" class="block mt-1 w-full" type="datetime-local" placeholder="01/01/2023" pattern="[0-9\./\]+" name="finish_time" :value="old('finish_time')" autofocus />
                        <x-input-error :messages="$errors->get('finish_time')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="note" :value="__('Note')" />
                    <textarea id="note" name="note" cols="30" rows="5" class="block mt-1 w-full focus:border-current focus:ring-0" type="text" :value="old('note')" autofocus />
                    </textarea>
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                </div>

                <div>
                    <button type="submit" class="mt-4 border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[1px] uppercase ">Prenota</button>
                </div>
            </form>

        </div>
    </div>
</x-business-layout>
