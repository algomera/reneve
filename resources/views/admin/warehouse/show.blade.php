@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="w-[90%] mx-auto">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-semibold mb-5">{{$product->name}}</h1>
            <a href="{{url()->previous()}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
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
@endsection
