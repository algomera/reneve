<x-business-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Collaboratori</h1>

            <table id="collaboratorTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl display cell">
                <thead class="!border-b-[2px] !border-white uppercase">
                    <tr>
                        <th>Id</th>
                        <th>Collaboratore</th>
                        <th>Cellulare</th>
                        <th>Email</th>
                        <th class="max-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collaborators as $cl )
                        <tr>
                            <td>{{$cl->id}}</td>
                            <td>{{$cl->name}} {{$cl->last_name}}</td>
                            <td>{{$cl->mobile_phone}}</td>
                            <td>{{$cl->email}}</td>
                            <td class="flex justify-center shrink gap-3">
                                <a href="{{route('business.collaborator.show', $cl->id)}}" title="view" id="show-'.$id.'" class="grow flex max-w-[100px] justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#1EC981] group">
                                    <img src="{{ asset('images/eyeglasses.svg') }}" alt="" class="scale-[1.2]">
                                </a>
                                @can('delete_collaborator', 'update_collaborator')
                                    <a href="{{route('business.collaborator.edit', $cl->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#ABB1B1] group">
                                        <img src="{{ asset('images/pensil.svg') }}" alt="" class="scale-[1.2]">
                                    </a>
                                    <button data-modal-toggle="popup-modal-delete{{$cl->id}}" title='delete' class='grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#EF5353] group'>
                                        <img src="{{ asset('images/delete.svg') }}" alt="" class="scale-[1.2]">
                                    </button>
                                    <x-modals.message modal='popup-modal-delete{{$cl->id}}' :id='$cl->id' message='Elimina' :name='$cl->name' route='business.collaborator.destroy'/>
                                @endcan
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
                $('#collaboratorTable').DataTable({
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
