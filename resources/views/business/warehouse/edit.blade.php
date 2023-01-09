<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-[26px] font-bold mb-5 capitalize">{{$product->name}}</h1>
            </div>

            <form action="{{Route('business.warehouse.update', $product->id)}}" method="post" class="flex relative">
                @csrf
                @method('PUT')

                <div class="w-1/2 bg-white p-5 mr-5 shadow-lg">
                    <div >
                        <x-input-label for="name" :value="__('Nome*')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="ref" :value="__('REF*')" />
                            <x-text-input id="ref" class="block mt-1 w-full" type="text" name="ref" :value="old('ref', $product->ref)" required autofocus />
                            <x-input-error :messages="$errors->get('ref')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="price" :value="__('Prezzo*')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" pattern="[0-9\.]+" name="price" :value="old('price', $product->price)" required autofocus />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-4 mt-4">
                        <div class="grow">
                            <x-input-label for="type" :value="__('Tipo*')" />
                            <select name="type" id="type" name="type" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$product->type == 'tipo-1' ? 'selected' : ''}} value="tipo-1">tipo-1</option>
                                <option {{$product->type == 'tipo-2' ? 'selected' : ''}} value="tipo-2">tipo-2</option>
                                <option {{$product->type == 'tipo-3' ? 'selected' : ''}} value="tipo-3">tipo-3</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div class="grow">
                            <x-input-label for="treatment" :value="__('Trattamento*')" />
                            <select name="treatment" id="treatment" name="treatment" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$product->treatment == 'viso' ? 'selected' : ''}} value="viso">viso</option>
                                <option {{$product->treatment == 'corpo' ? 'selected' : ''}} value="corpo">corpo</option>
                                <option {{$product->treatment == 'gambe' ? 'selected' : ''}} value="gambe">gambe</option>
                                <option {{$product->treatment == 'totale' ? 'selected' : ''}} value="totale">totale</option>
                            </select>
                            <x-input-error :messages="$errors->get('treatment')" class="mt-2" />
                        </div>
                        <div class="grow">
                            <x-input-label for="product_line" :value="__('Linea Prodotto*')" />
                            <select name="product_line" id="product_line" name="product_line" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$product->product_line == 'linea-1' ? 'selected' : ''}} value="linea-1">linea-1</option>
                                <option {{$product->product_line == 'linea-2' ? 'selected' : ''}} value="linea-2">linea-2</option>
                                <option {{$product->product_line == 'linea-3' ? 'selected' : ''}} value="linea-3">linea-3</option>
                            </select>
                            <x-input-error :messages="$errors->get('product_line')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="w-1/2 bg-white p-5 shadow-lg">
                    <div>
                        <x-input-label for="description" :value="__('Descrizione')" />
                        <textarea id="description" name="description" cols="30" rows="5" class="block mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" description="description" autofocus />
                            {{old('description', $product->description)}}
                        </textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Contenuto*')" />
                        <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="old('content', $product->content)" required autofocus />
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>
                    <div class="flex gap-3 mt-4">
                        <div class="w-1/2">
                            <x-input-label for="discount" :value="__('Tipo Proposta')" />
                            <select name="product_line" id="product_line" name="product_line" class="mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option disabled selected value="">Seleziona</option>
                                <option {{$product->discount == '10' ? 'selected' : ''}} value="10">Standard</option>
                                <option {{$product->discount == '20' ? 'selected' : ''}} value="20">Platinum</option>
                                <option {{$product->discount == '30' ? 'selected' : ''}} value="30">Diamond</option>
                                <option {{$product->discount == '40' ? 'selected' : ''}} value="40">Total Face</option>
                                <option {{$product->discount == '50' ? 'selected' : ''}} value="50">Total Body</option>
                            </select>
                            <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                        </div>
                        <div class="w-1/2">
                            <x-input-label for="qta" :value="__('Quantità')" />
                            <x-text-input id="qta" class="block mt-1 w-full" type="text" name="qta" pattern="[0-9]+" :value="old('qta', $product->qta)" autofocus />
                            <x-input-error :messages="$errors->get('qta')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex gap-10 mt-4">
                        <div class="mt-4 flex gap-3 items-center mb-10">
                            <x-input-label for="put_of_print" :value="__('Fuori catalogo')" />
                            <input id="put_of_print" type="checkbox" name="put_of_print" value="1" @if ($product->put_of_print == 1 ) checked @endif autofocus />
                            <x-input-error :messages="$errors->get('put_of_print')" class="mt-2" />
                        </div>
                        <div class="mt-4 flex gap-3 items-center mb-10">
                            <x-input-label for="price_visible" :value="__('Prezzo visibile')" />
                            <input id="price_visible" type="checkbox" name="price_visible" value="1" @if ($product->price_visible == 1 ) checked @endif autofocus />
                            <x-input-error :messages="$errors->get('price_visible')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-[-60px] right-0 flex gap-3">
                    <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>

                    <button type="submit" class="px-7 py-3 bg-[#6EA0FF] text-[13px] font-bold uppercase text-white hover:bg-[#85AFFD] tracking-[0.75px]">Modifica</button>
                </div>
            </form>

        </div>
    </div>
</x-business-layout>
