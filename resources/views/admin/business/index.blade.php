@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Aziende</h1>

            <form class="form-inline z-10 absolute" method="GET" role="form">
                <label for="perPage">Record:  </label>
                <select onchange="this.form.submit()" class="form-control h-[38px] bg-transparent rounded-sm border-[#aaa] focus:border-transparent " id="perPage" name="perPage">
                    <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>

            <table id="businessTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl cell-border display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">Name</th>
                        <th class="text-start p-2">Type</th>
                        <th class="text-start p-2">Email</th>
                        <th class="text-start p-2">Phone</th>
                        <th class="text-start p-2">Mobile Phone</th>
                        <th class="text-start p-2">Created</th>
                        <th class="text-start p-2">Delete</th>
                        <th class=" min-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($businesses as $bs )
                        @if ($bs->business == 'reneve')
                        @else
                        <tr class="odd:bg-gray-600/50 even:bg-gray-600/100">
                            <td>{{$bs->id}}</td>
                            <td>{{$bs->business}}</td>
                            <td class="capitalize">{{$bs->type_business}}</td>
                            <td>{{$bs->email_business}}</td>
                            <td>{{$bs->telephone_business}}</td>
                            <td>{{$bs->mobile_phone_business}}</td>
                            <td>{{$bs->created_at->format('d-m-Y')}}</td>
                            <td>{{$bs->deleted_at ? $bs->deleted_at->format('d-m-Y') : ''}}</td>
                            <td class="flex shrink gap-1">
                                @if ($bs->deleted_at)
                                    <button data-modal-toggle="popup-modal-restore-delete{{$bs->id}}" title='restore' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                        <i class="fa-solid fa-trash-arrow-up"></i>
                                    </button>
                                    <x-modals.message modal='popup-modal-restore-delete{{$bs->id}}' :id='$bs->id' message='Ripristina' :name='$bs->business' route='admin.businessRestore'/>

                                    <button data-modal-toggle="popup-modal-hard-delete{{$bs->id}}" title='hard delete' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                        <i class="fa-solid fa-xmark text-red-500/80 group-hover:text-white"></i>
                                    </button>
                                    <x-modals.message modal='popup-modal-hard-delete{{$bs->id}}' :id='$bs->id' message='Elimina definitivamente' :name='$bs->business' route='business.destroy'/>
                                @else
                                    <a href="{{route('business.show', $bs->id)}}" title="view" id="show-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                                        <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
                                    </a>
                                    <a href="{{route('business.edit', $bs->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-yellow-500/80 rounded-md hover:bg-yellow-500/80 group">
                                        <i class="fa-solid fa-pen-to-square text-yellow-500 group-hover:text-white"></i>
                                    </a>
                                    <button data-modal-toggle="popup-modal-soft-delete{{$bs->id}}" title='soft delete' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                        <i class="fa-solid fa-trash text-red-500 group-hover:text-white"></i>
                                    </button>
                                    <x-modals.message modal='popup-modal-soft-delete{{$bs->id}}' :id='$bs->id' message='Elimina' :name='$bs->business' route='business.destroy'/>
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
@endsection

@push('scripts')
    <script type="module">
        $(document).ready( function () {
            $('#businessTable').DataTable({
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
