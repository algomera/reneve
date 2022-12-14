<x-admin-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-[26px] font-bold">Ordine N° {{$order->id}}</h1>
                    <p>Azienda ordinante: <strong class="tracking-[0.5px]">{{$order->business->business}}</strong></p>
                    <p>P.IVA: <strong class="tracking-[0.75px]">{{$order->business->p_iva_business}}</strong></p>
                </div>
                <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>
            </div>

            <h4 class="text-lg font-semibold">Note:</h4>
            <div class="w-[70%] min-h-[70px] p-3 border border-gray-700/50 rounded-sm shadow-md mb-8">
                @if ($order->notes)
                <p>{{$order->notes}}</p>
                @else
                <p>Nessuna Nota..</p>
                @endif
            </div>
            <h3 class="text-[22px] font-bold mt-3 mb-[-45px] uppercase">Prodotti in Ordine</h3>

            <table id="orderTable" class="w-full bg-slate-500 table-auto text-white cell display">
                <thead class="!border-b-[2px] !border-white uppercase bg-[#272E3B]">
                    <tr>
                        <th class="text-start p-2">ID</th>
                        <th class="text-start p-2">REF</th>
                        <th class="text-start p-2">Fornitore</th>
                        <th class="text-start p-2">Nome</th>
                        <th class="text-start p-2">Prezzo</th>
                        <th class="text-start p-2">quantità</th>
                        <th class="text-start p-2">totale</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pr )
                        <tr class="odd:bg-[#343F52] even:bg-[#3F4A5F]">
                            <td>{{$pr->id}}</td>
                            <td>{{$pr->ref}}</td>
                            <td>{{$pr->business->business}}</td>
                            <td>{{$pr->name}}</td>
                            <td>€ {{$pr->price}}</td>
                            <td>{{$pr->pivot->qta}}</td>
                            <td>€ {{number_format($pr->total, 2 , ',', '.')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-full flex justify-end mt-2">
                <p class="text-[21px]"><strong>Totale Ordine: </strong> € {{number_format($order->total, 2 , ',', '.')}}</p>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready( function () {
                $('#orderTable').DataTable({
                    "bPaginate":false,
                    "bInfo":false,
                    "oLanguage": {
                        "sZeroRecords": "Nessun risultato trovato!",
                    },
                });
                $('.dataTables_filter').addClass('mb-[15px]')
            } );
        </script>
    @endpush
</x-admin-layout>

