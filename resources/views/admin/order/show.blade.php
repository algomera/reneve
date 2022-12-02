@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-semibold">Ordine N° {{$order->id}}</h1>
                    <p>Azienda ordinante: <strong class="tracking-[0.5px]">{{$order->business->business}}</strong></p>
                    <p>P.IVA: <strong class="tracking-[0.75px]">{{$order->business->p_iva_business}}</strong></p>
                </div>
                <a href="{{route('order.index')}}" class="border-[2px] border-gray-800/80 px-5 py-2 rounded-md bg-gray-800/80 text-white hover:bg-transparent hover:text-black tracking-[0.75px]">Indietro</a>
            </div>

            <h4 class="text-lg font-semibold">Note:</h4>
            <div class="w-[70%] min-h-[70px] p-3 border border-gray-700/50 rounded-sm shadow-md mb-8">
                @if ($order->notes)
                <p>{{$order->notes}}</p>
                @else
                <p>Nessuna Nota..</p>
                @endif
            </div>
            <h3 class="text-2xl font-semibold mt-3 mb-[-45px] uppercase">Prodotti in Ordine</h3>

            <table id="orderTable" class="w-full table-auto text-white shadow-2xl cell-border display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/90">
                    <tr>
                        <th class="text-start p-2">ID</th>
                        <th class="text-start p-2">REF</th>
                        <th class="text-start p-2">Fornitore</th>
                        <th class="text-start p-2">Nome</th>
                        <th class="text-start p-2">Prezzo</th>
                        <th class="text-start p-2">quantità</th>
                        <th class="text-start p-2">total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pr )
                        <tr class="odd:bg-gray-900/80 even:bg-gray-900/70">
                            <td>{{$pr->id}}</td>
                            <td>{{$pr->ref}}</td>
                            <td>{{$pr->business->business}}</td>
                            <td>{{$pr->name}}</td>
                            <td>{{$pr->price}} €</td>
                            <td>{{$pr->pivot->qta}}</td>
                            <td>{{$pr->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-full flex justify-end mt-2">
                <p class="text-[21px]"><strong>Totale Ordine: </strong> € {{$order->products->sum('price')}}</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready( function () {
            $('#orderTable').DataTable({
                "bPaginate":false, "bInfo":false
            });
            $('.dataTables_filter').addClass('mb-[15px]')
        } );
    </script>
@endpush
