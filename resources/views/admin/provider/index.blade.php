<x-admin-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Servizi</h1>

            <form class="form-inline z-10 absolute" method="GET" role="form">
                <label for="perPage">Record:  </label>
                <select onchange="this.form.submit()" class="form-control h-[38px] bg-transparent rounded-sm border-[#aaa] focus:border-transparent " id="perPage" name="perPage">
                    <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>

            <table id="providersTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl cell-border display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>durata</th>
                        <th>prezzo</th>
                        <th>Creato il</th>
                        <th class=" min-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($providers as $pv )
                        <tr class="odd:bg-gray-600/50 even:bg-gray-600/100">
                            <td>{{$pv->id}}</td>
                            <td>{{$pv->name}}</td>
                            <td class="capitalize">{{$pv->type}}</td>
                            <td>{{$pv->duration}} Min.</td>
                            <td>€ {{number_format($pv->price, 2 , ',', '.')}}</td>
                            <td>{{$pv->created_at->format('d-m-Y')}}</td>
                            <td class="flex shrink gap-1">
                                <a href="{{route('admin.service.show', $pv->id)}}" title="view" id="show-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                                    <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
                                </a>
                                <a href="{{route('admin.service.edit', $pv->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-yellow-500/80 rounded-md hover:bg-yellow-500/80 group">
                                    <i class="fa-solid fa-pen-to-square text-yellow-500 group-hover:text-white"></i>
                                </a>
                                <button data-modal-toggle="popup-modal-delete{{$pv->id}}" title='delete' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                    <i class="fa-solid fa-trash text-red-500 group-hover:text-white"></i>
                                </button>
                                <x-modals.message modal='popup-modal-delete{{$pv->id}}' :id='$pv->id' message='Elimina' :name='$pv->name' route='admin.service.destroy'/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-[15px]">
                {{$providers->links()}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready( function () {
                $('#providersTable').DataTable({
                    order: [[0, 'desc']],
                    "bPaginate":false,
                    "bInfo":false,
                    "oLanguage": {
                        "sZeroRecords": "Nessun risultato trovato!",
                        "sProcessing": "Caricamento Dati..."
                    },
                });
                $('.dataTables_filter').addClass('mb-[15px]');
            } );
        </script>
    @endpush
</x-admin-layout>

