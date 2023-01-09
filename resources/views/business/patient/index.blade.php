<x-business-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-[26px] font-bold mb-5">Lista Pazienti</h1>

            <table id="patientTable" class="w-full table-auto bg-slate-500 text-white cell display">
                <thead class="!border-b-[2px] !border-white uppercase bg-[#272E3B]">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">Paziente</th>
                        <th class="text-start p-2">nato il</th>
                        <th class="text-start p-2">professione</th>
                        <th class="text-start p-2">email</th>
                        <th class="text-start p-2">cellulare</th>
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
                var table = $('#patientTable').DataTable({
                    "oLanguage": {
                        "sZeroRecords": "Nessun Paziente trovato!",
                    },
                    order: [[0, 'desc']],
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('business.patient.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'date_of_birth', name: 'date_of_birth'},
                        {data: 'profession', name: 'profession'},
                        {data: 'email', name: 'email'},
                        {data: 'mobile_phone', name: 'mobile_phone'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                $('select').addClass('w-[65px] mb-[15px]');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#patientTable').on('click', '.ajax', function (ele) {
                    ele.preventDefault();
                    const msg = 'Eliminare questo paziente?';
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
</x-business-layout>
