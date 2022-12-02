@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Ordini</h1>

            {{-- <form class="form-inline z-10 absolute" method="GET" role="form">
                <label for="perPage">Record:  </label>
                <select onchange="this.form.submit()" class="form-control h-[38px] bg-transparent rounded-sm border-[#aaa] focus:border-transparent " id="perPage" name="perPage">
                    <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option {{ $perPage == 'Tutti' ? 'selected' : '' }}>Tutti</option>
                </select>
            </form> --}}

            <table id="orderTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl cell-border display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">Azienda</th>
                        <th class="text-start p-2">Importo</th>
                        <th class="text-start p-2">Data</th>
                        <th class="text-start p-2">Stato Ordine</th>
                        <th class="text-start p-2">Pagamento</th>
                        <th class="">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $or )
                        <tr class="odd:bg-gray-600/50 even:bg-gray-600/100 ">
                            <td>{{$or->id}}</td>
                            <td>{{$or->business->business}}</td>
                            <td>{{$or->products->sum('price')}} €</td>
                            <td>{{$or->created_at->format('d-m-Y')}} ore: {{$or->created_at->format('h:i')}}</td>
                            <td class="uppercase">{{$or->status}}</td>
                            <td></td>
                            <td>
                                <a href="{{route('order.show', $or->id)}}" title="view" id="show-'.$id.'" class="flex justify-center items-center py-1 border-[2px] border-green-500/80 rounded-md hover:bg-green-500/80 group">
                                    <i class="fa-regular fa-eye text-green-500 group-hover:text-white"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Todo aggiungere colonna pagamento in orders Table --}}
            {{-- Todo risolvere velocita caricamento dati --}}
            {{-- @if ($perPage != 'Tutti')
                <div class="mt-[15px]">
                    {{$orders->links()}}
                </div>
            @endif --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready( function () {
            $('#orderTable').DataTable({
                "bPaginate":true,
                "bInfo":true,
                "bProcessing": true,
                "processing": true,
                "oLanguage": {
                    "sZeroRecords": "Nessun risultato trovato!",
                    "sProcessing": "Caricamento Dati..."
                },
            });
            $('.dataTables_filter').addClass('mb-[15px]');
            $('select').addClass('w-[60px]')
        } );
    </script>
@endpush
