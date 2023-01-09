<x-business-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-[26px] font-bold mb-5">Lista Trattamenti</h1>

            <table id="providersTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl display cell">
                <thead class="!border-b-[2px] !border-white uppercase">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>durata</th>
                        <th>prezzo</th>
                        <th>Creato il</th>
                        <th class="max-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($providers as $pv )
                        <tr>
                            <td>{{$pv->id}}</td>
                            <td>{{$pv->name}}</td>
                            <td class="capitalize">{{$pv->type}}</td>
                            <td>{{$pv->duration}} Min.</td>
                            <td>€ {{number_format($pv->price, 2 , ',', '.')}}</td>
                            <td>{{$pv->created_at->format('d-m-Y')}}</td>
                            <td class="flex justify-center shrink gap-3">
                                <a href="{{route('business.provider.show', $pv->id)}}" title="view" id="show-'.$id.'" class="grow flex max-w-[100px] justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#1EC981] group">
                                    <img src="{{ asset('images/eyeglasses.svg') }}" alt="" class="scale-[1.2]">
                                </a>
                                @if (!in_array($pv->id, $allAdminProvider))
                                    @can('delete_treatment', 'update_treatment')
                                        <a href="{{route('business.provider.edit', $pv->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#ABB1B1] group">
                                            <img src="{{ asset('images/pensil.svg') }}" alt="" class="scale-[1.2]">
                                        </a>
                                        <button data-modal-toggle="popup-modal-delete{{$pv->id}}" title='delete' class='grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#EF5353] group'>
                                            <img src="{{ asset('images/delete.svg') }}" alt="" class="scale-[1.2]">
                                        </button>
                                        <x-modals.message modal='popup-modal-delete{{$pv->id}}' :id='$pv->id' message='Elimina' :name='$pv->name' route='business.provider.destroy'/>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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

</x-business-layout>
