@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Ordini</h1>

            <table id="orderTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl cell-border display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">Azienda</th>
                        <th class="text-start p-2">Data</th>
                        <th class="text-start p-2">Stato Ordine</th>
                        <th class="text-start p-2">Pagamento</th>
                        <th class="text-start p-2">Importo</th>
                        <th class="">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- DataTable --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(function () {
            var table = $('#orderTable').DataTable({
                "oLanguage": {
                    "sZeroRecords": "Nessun risultato trovato!",
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'business.business', name: 'business.business'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'payment', name: 'payment'},
                    {data: 'amount', name: 'amount', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('select').addClass('w-[65px] mb-[15px]');
        });
      </script>
@endpush
