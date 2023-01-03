<x-admin-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-center items-center">
                <h1 class="text-[26px] font-bold mb-5">{{$provider->name}}</h1>
            </div>

            <form action="{{Route('admin.service.update', $provider->id)}}" method="POST" class="w-1/2 m-auto flex flex-col relative">
                @csrf
                @method('PUT')

                <input hidden type="number" id="business_id" name="business_id" value="1">
                <input hidden type="boolean" id="available" name="available" value="1">

                <div class="w-full bg-white p-5 mt-5 mr-5 shadow-lg">
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="name" :value="__('Nome*')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $provider->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="price" :value="__('Prezzo consigliato*')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" pattern="[0-9\.]+" name="price" :value="old('price', $provider->price)" required autofocus />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-4 mt-4">
                        <div class="grow">
                            <x-input-label for="type" :value="__('Tipo*')" />
                            <select name="type" id="type" name="type" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$provider->type == 'trattamento corpo' ? 'selected': ''}} value="trattamento corpo">Trattamento Corpo</option>
                                <option {{$provider->type == 'trattamento viso' ? 'selected': ''}} value="trattamento viso">Trattamento Viso</option>
                                <option {{$provider->type == 'trattamento mani' ? 'selected': ''}} value="trattamento mani">Trattamento Mani</option>
                                <option {{$provider->type == 'trattamento gambe' ? 'selected': ''}} value="trattamento gambe">Trattamento gambe</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div class="grow">
                            <x-input-label for="duration" :value="__('Durata (Min)*')" />
                            <select name="duration" id="duration" name="duration" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$provider->duration == '10' ? 'selected': ''}} value="10">10</option>
                                <option {{$provider->duration == '20' ? 'selected': ''}} value="20">20</option>
                                <option {{$provider->duration == '30' ? 'selected': ''}} value="30">30</option>
                                <option {{$provider->duration == '40' ? 'selected': ''}} value="40">40</option>
                            </select>
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="w-full bg-white p-5 mt-5 shadow-lg">
                    <div>
                        <x-input-label for="description" :value="__('Descrizione')" />
                        <textarea id="description" name="description" cols="30" rows="5" class="block mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" description="description" :value="old('description')" autofocus />
                            {{$provider->description}}
                        </textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <div class="absolute bottom-[-60px] right-0 flex gap-3">
                    <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>

                    <button type="submit" class="px-7 py-3 bg-[#6EA0FF] text-[13px] font-bold uppercase text-white hover:bg-[#85AFFD] tracking-[0.75px]">Modifica</button>
                </div>

            </form>

        </div>
    </div>
</x-admin-layout>
