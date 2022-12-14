<x-admin-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-[26px] font-bold mb-5">Lista Aziende</h1>

            <form class="form-inline z-10 absolute" method="GET" role="form">
                <label for="perPage">Record:  </label>
                <select onchange="this.form.submit()" class="form-control h-[38px] bg-transparent rounded-sm border-[#aaa] focus:border-transparent " id="perPage" name="perPage">
                    <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>

            <table id="businessTable" class="w-full table-auto bg-slate-500 text-white cell display">
                <thead class="!border-b-[2px] !border-white uppercase bg-[#272E3B]">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">Nome</th>
                        <th class="text-start p-2">Tipo</th>
                        <th class="text-start p-2">Email</th>
                        <th class="text-start p-2">Telefono</th>
                        <th class="text-start p-2">Cellulare</th>
                        <th class="text-start p-2">Creata</th>
                        <th class="text-start p-2">Eliminata</th>
                        <th class="max-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($businesses as $bs )
                        @if ($bs->business == 'reneve')
                        @else
                        <tr class="odd:bg-[#343F52] even:bg-[#3F4A5F]">
                            <td>{{$bs->id}}</td>
                            <td>{{$bs->business}}</td>
                            <td class="capitalize">{{$bs->type_business}}</td>
                            <td>{{$bs->email_business}}</td>
                            <td>{{$bs->telephone_business}}</td>
                            <td>{{$bs->mobile_phone_business}}</td>
                            <td>{{$bs->created_at->format('d-m-Y')}}</td>
                            <td>{{$bs->deleted_at ? $bs->deleted_at->format('d-m-Y') : ''}}</td>
                            <td class="flex shrink gap-3">
                                @if ($bs->deleted_at)
                                    <button data-modal-toggle="popup-modal-restore-delete{{$bs->id}}" title='restore' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                        <i class="fa-solid fa-trash-arrow-up"></i>
                                    </button>
                                    <x-modals.message modal='popup-modal-restore-delete{{$bs->id}}' :id='$bs->id' message='Ripristina' :name='$bs->business' route='admin.businessRestore'/>

                                    <button data-modal-toggle="popup-modal-hard-delete{{$bs->id}}" title='hard delete' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                        <i class="fa-solid fa-xmark text-red-500/80 group-hover:text-white"></i>
                                    </button>
                                    <x-modals.message modal='popup-modal-hard-delete{{$bs->id}}' :id='$bs->id' message='Elimina definitivamente' :name='$bs->business' route='admin.business.destroy'/>
                                @else
                                    <a href="{{route('admin.business.show', $bs->id)}}" title="view" id="show-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#1EC981] group">
                                        <img src="{{ asset('images/eyeglasses.svg') }}" alt="" class="scale-[1.2]">
                                    </a>
                                    <a href="{{route('admin.business.edit', $bs->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#ABB1B1] group">
                                        <img src="{{ asset('images/pensil.svg') }}" alt="" class="scale-[1.2]">
                                    </a>
                                    <button data-modal-toggle="popup-modal-soft-delete{{$bs->id}}" title='soft delete' class='grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#EF5353] group'>
                                        <img src="{{ asset('images/delete.svg') }}" alt="" class="scale-[1.2]">
                                    </button>
                                    <x-modals.message modal='popup-modal-soft-delete{{$bs->id}}' :id='$bs->id' message='Elimina' :name='$bs->business' route='admin.business.destroy'/>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="mt-[15px]">
                {{$businesses->links()}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready( function () {
                $('#businessTable').DataTable({
                    order: [[0, 'desc']],
                    "sScrollY": "480px",
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

