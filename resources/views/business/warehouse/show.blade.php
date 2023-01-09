<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center mb-3">
                <h1 class="text-[26px] font-bold mb-5">{{$product->name}}</h1>
                <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>
            </div>

            <div class="w-full bg-white shadow-lg p-5 flex">
                <div class="w-full">
                    <div class="flex flex-col gap-1">
                        <span class="capitalize"><strong>ID:</strong> {{$product->id}}</span>
                        <hr class="py-1">
                        <span><strong>REF:</strong> {{$product->ref}}</span>
                        <hr class="py-1">
                        <span><strong>Descrizione:</strong> {{$product->description}}</span>
                        <hr class="py-1">
                        <span><strong>Contenuto:</strong> {{$product->content}}</span>
                        <hr class="py-1">
                        <span><strong>Tipologia:</strong> {{$product->type}}</span>
                        <hr class="py-1">
                        <span><strong>Tipo di trattamento:</strong> {{$product->treatment}}</span>
                        <hr class="py-1">
                        <span><strong>Linea prodotto:</strong> {{$product->product_line}}</span>
                        <hr class="py-1">
                        <span><strong>Fuori catalogo:</strong> {{$product->put_of_print == 1 ? 'Si' : 'No'}}</span>
                        <hr class="py-1">
                        <span><strong>Sconto:</strong> {{$product->discount}}%</span>
                        <hr class="py-1">
                        <span><strong>Prezzo:</strong> € {{$product->price}}</span>
                        <hr class="py-1">
                        <span><strong>Prezzo Visibile al cliente:</strong> {{$product->price_visible == 1 ? 'Si' : 'No'}}</span>
                        <hr class="py-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-business-layout>
