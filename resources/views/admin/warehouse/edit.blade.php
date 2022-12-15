<x-admin-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">{{$product->name}}</h1>
                <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <form action="{{Route('admin.warehouse.update', $product->id)}}" method="post" class="flex bg-white p-5 shadow-lg relative">
                @csrf
                @method('PUT')

                <div class="w-1/2 pr-5">
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
                            <select name="type" id="type" name="type" class="w-full" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$product->type == 'tipo-1' ? 'selected' : ''}} value="tipo-1">tipo-1</option>
                                <option {{$product->type == 'tipo-2' ? 'selected' : ''}} value="tipo-2">tipo-2</option>
                                <option {{$product->type == 'tipo-3' ? 'selected' : ''}} value="tipo-3">tipo-3</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div class="grow">
                            <x-input-label for="treatment" :value="__('Trattamento*')" />
                            <select name="treatment" id="treatment" name="treatment" class="w-full" required>
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
                            <select name="product_line" id="product_line" name="product_line" class="w-full" required>
                                <option disabled selected value="">Seleziona</option>
                                <option {{$product->product_line == 'linea-1' ? 'selected' : ''}} value="linea-1">linea-1</option>
                                <option {{$product->product_line == 'linea-2' ? 'selected' : ''}} value="linea-2">linea-2</option>
                                <option {{$product->product_line == 'linea-3' ? 'selected' : ''}} value="linea-3">linea-3</option>
                            </select>
                            <x-input-error :messages="$errors->get('product_line')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="w-1/2 border-l pl-5">
                    <div>
                        <x-input-label for="description" :value="__('Descrizione')" />
                        <textarea id="description" name="description" cols="30" rows="5" class="block mt-1 w-full" type="text" description="description" autofocus />
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
                            <select name="product_line" id="product_line" name="product_line" class="mt-1 w-full">
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
                    <div>
                        <div class="mt-4 flex gap-3 items-center mb-10">
                            <x-input-label for="put_of_print" :value="__('Fuori catalogo')" />
                            <x-text-input id="put_of_print" type="checkbox" name="put_of_print" :value="old('put_of_print', $product->put_of_print)" autofocus />
                            <x-input-error :messages="$errors->get('put_of_print')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="absolute bottom-5 right-5 border px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-green-800/70 tracking-[0.75px] ">Modifica</button>
            </form>

        </div>
    </div>
</x-admin-layout>
