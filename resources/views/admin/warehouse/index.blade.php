<x-admin-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Prodotti</h1>

            <table id="productTable" class="w-full bg-slate-500 table-auto text-white cell display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">ref</th>
                        <th class="text-start p-2">Nome</th>
                        <th class="text-start p-2">Tipo</th>
                        <th class="text-start p-2">Trattamento</th>
                        <th class="text-start p-2">Ln. Prodotto</th>
                        <th class="text-start p-2">Quantità</th>
                        <th class="text-start p-2">Sconto</th>
                        <th class="text-start p-2">Pr. Visibile</th>
                        <th class="min-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- DataTable --}}
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(function () {
                var table = $('#productTable').DataTable({
                    "oLanguage": {
                        "sZeroRecords": "Nessun risultato trovato!",
                    },
                    order: [[0, 'desc']],
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.warehouse.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'ref', name: 'ref'},
                        {data: 'name', name: 'name'},
                        {data: 'type', name: 'type'},
                        {data: 'treatment', name: 'treatment'},
                        {data: 'product_line', name: 'product_line'},
                        {data: 'qta', name: 'qta'},
                        {data: 'discount', name: 'discount'},
                        {data: 'price_visible', name: 'price_visible'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                $('select').addClass('w-[65px] mb-[15px]');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#productTable').on('click', '.ajax', function (ele) {
                    ele.preventDefault();
                    const msg = 'Eliminare questo prodotto?';
                    if(!confirm(msg)){
                        return false;
                    }

                    var tr = this.parentNode.parentNode;
                    $.ajax({
                        url: $(this).attr('href'),
                        method: 'DELETE',
                        complete: function() {
                            tr.parentNode.removeChild(tr);
                            table.ajax.reload();
                        }
                    })
                });
            });
        </script>
    @endpush
</x-admin-layout>

