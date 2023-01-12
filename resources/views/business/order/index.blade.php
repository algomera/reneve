<x-business-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Lista Ordini</h1>

            <form class="form-inline z-10 absolute" method="GET" role="form">
                <label for="perPage">Record:  </label>
                <select onchange="this.form.submit()" class="form-control h-[38px] bg-transparent rounded-sm border-[#aaa] focus:border-transparent " id="perPage" name="perPage">
                    <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>

            <table id="orderTable" class="w-full bg-slate-500 table-auto text-white cell display">
                <thead class="!border-b-[2px] !border-white uppercase bg-gray-900/60">
                    <tr>
                        <th class="text-start p-2">Id</th>
                        <th class="text-start p-2">data</th>
                        <th class="text-start p-2">stato</th>
                        <th class="text-start p-2">pagamento</th>
                        <th class="text-start p-2">importo</th>
                        <th class="min-w-[120px] max-w-[200px]">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order )
                        <tr class="odd:bg-[#343F52] even:bg-[#3F4A5F]">
                            <td>{{$order->id}}</td>
                            <td>{{$order->created_at->format('d-m-Y')}}</td>
                            <td>{{$order->status}}</td>
                            <td class="capitalize">{{$order->payment}}</td>
                            <td class="capitalize">{{$order->total}}</td>
                            <td class="flex justify-center gap-3">
                                <a href="{{route('admin.business.show', $order->id)}}" title="view" id="show-'.$id.'" class="grow flex justify-center max-w-[100px] w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#1EC981] group">
                                    <img src="{{ asset('images/eyeglasses.svg') }}" alt="" class="scale-[1.2]">
                                </a>
                                @if ($order->status == 'Inviato')
                                    <a href="{{route('admin.business.edit', $order->id)}}" title="update" id="edit-'.$id.'" class="grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#ABB1B1] group">
                                        <img src="{{ asset('images/pensil.svg') }}" alt="" class="scale-[1.2]">
                                    </a>
                                    <button data-modal-toggle="popup-modal-soft-delete{{$order->id}}" title='soft delete' class='grow flex justify-center w-[36px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#EF5353] group'>
                                        <img src="{{ asset('images/delete.svg') }}" alt="" class="scale-[1.2]">
                                    </button>
                                    <x-modals.message modal='popup-modal-soft-delete{{$order->id}}' :id='$order->id' message='Elimina' :name='$order->business' route='admin.business.destroy'/>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-[15px]">
                {{$orders->links()}}
            </div>

        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready( function () {
                $('#orderTable').DataTable({
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

</x-business-layout>
