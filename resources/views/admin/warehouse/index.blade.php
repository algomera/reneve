@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Prodotti</h1>

            <form class="form-inline z-10 absolute" method="GET" role="form">
                <label for="perPage">Record:  </label>
                <select onchange="this.form.submit()" class="form-control h-[38px] bg-transparent rounded-sm border-[#aaa] focus:border-transparent " id="perPage" name="perPage">
                    <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option {{ $perPage == 'Tutti' ? 'selected' : '' }}>Tutti</option>
                </select>
            </form>

            <table id="productTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl cell-border display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">ref</th>
                        <th class="text-start p-2">Name</th>
                        <th class="text-start p-2">Type</th>
                        <th class="text-start p-2">Treatment</th>
                        <th class="text-start p-2">product line</th>
                        <th class="text-start p-2">quantity</th>
                        <th class="text-start p-2">discount</th>
                        <th class="text-start p-2">visibile</th>
                        <th class=" min-w-[120px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pr )
                        <tr class="odd:bg-gray-600/50 even:bg-gray-600/100">
                            <td>{{$pr->id}}</td>
                            <td>{{$pr->ref}}</td>
                            <td>{{$pr->name}}</td>
                            <td>{{$pr->type}}</td>
                            <td>{{$pr->treatment}}</td>
                            <td>{{$pr->product_line}}</td>
                            <td>{{$pr->qta}}</td>
                            <td>{{$pr->discount}}%</td>
                            <td>
                                <div class="flex items-center justify-center">
                                    @if ($pr->price_visible)
                                    <i class="fa-regular fa-eye"></i>
                                    @else
                                    <i class="fa-regular fa-eye-slash"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="flex shrink gap-1">
                                <a href="{{route('warehouse.show', $pr->id)}}" title="view" id="show-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                                    <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
                                </a>
                                <a href="{{route('warehouse.edit', $pr->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center items-center py-1 border-[2px] border-yellow-500/80 rounded-md hover:bg-yellow-500/80 group">
                                    <i class="fa-solid fa-pen-to-square text-yellow-500 group-hover:text-white"></i>
                                </a>
                                <button data-modal-toggle="popup-modal-delete{{$pr->id}}" title='delete' class='grow flex justify-center items-center py-1 border-[2px] rounded-md border-red-500/80 hover:bg-red-500/80 group'>
                                    <i class="fa-solid fa-trash text-red-500 group-hover:text-white"></i>
                                </button>
                                <x-modals.message modal='popup-modal-delete{{$pr->id}}' :id='$pr->id' message='Elimina' :name='$pr->name' route='warehouse.destroy'/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($perPage != 'Tutti')
                <div class="mt-[15px]">
                    {{$products->links()}}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script type="module">
    $(document).ready( function () {
        $('#productTable').DataTable({
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
