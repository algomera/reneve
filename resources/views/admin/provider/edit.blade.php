@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="w-[90%] mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold mb-5">{{$provider->name}}</h1>
            <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
        </div>

        <form action="{{Route('service.update', $provider->id)}}" method="POST" class="flex bg-white p-5 mt-5 shadow-lg relative">
            @csrf
            @method('PUT')

            <input hidden type="number" id="business_id" name="business_id" value="1">
            <input hidden type="boolean" id="available" name="available" value="1">

            <div class="w-1/2 pr-5">
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
                        <select name="type" id="type" name="type" class="w-full" required>
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
                        <select name="duration" id="duration" name="duration" class="w-full" required>
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

            <div class="w-1/2 border-l pl-5">
                <div>
                    <x-input-label for="description" :value="__('Descrizione')" />
                    <textarea id="description" name="description" cols="30" rows="5" class="block mt-1 w-full" type="text" description="description" :value="old('description')" autofocus />
                        {{$provider->description}}
                    </textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="flex justify-end mt-5">
                    <button type="submit" class="border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[0.75px] ">Modifica</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
