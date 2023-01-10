<x-business-layout>
    @section('css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    @endsection

    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <h1 class="text-3xl font-semibold mb-5">Cabine</h1>

            <div class="flex gap-5">
                <div class="w-1/2 p-5 mt-[50px] border shadow-lg">
                    <h3 class="text-[20px] font-bold mb-5 tracking-[0.75px]">Crea nuova</h3>

                    <form action="{{Route('business.cabin.store')}}" method="post" class="relative">
                        @csrf
                        <div class="grow">
                            <x-input-label for="name" :value="__('Nome*')" />
                            <x-text-input id="name" class="block mt-1 w-full shadow-sm" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="absolute bottom-[-60px] right-0 flex gap-3">
                            <button type="submit" class="px-7 py-3 bg-[#6EA0FF] text-[13px] font-bold uppercase text-white hover:bg-[#85AFFD] tracking-[0.75px]">Inserisci</button>
                        </div>
                    </form>


                </div>
                <div class="w-1/2">
                    <table id="cabinTable" class="w-full bg-slate-500 table-auto text-white shadow-2xl display cell">
                        <thead class="!border-b-[2px] !border-white uppercase">
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th class="max-w-[120px]">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cabins as $cb )
                                <tr>
                                    <td>{{$cb->id}}</td>
                                    <td>{{$cb->name}} {{$cb->last_name}}</td>
                                    <td class="flex justify-center shrink gap-3">
                                        @can('create_room', 'delete_room', 'update_room')
                                            <button data-modal-toggle="popup-modal-delete{{$cb->id}}" title='delete' class='grow flex justify-center max-w-[100px] h-[30px] hover:bg-[#27272A] items-center rounded-md bg-[#EF5353] group'>
                                                <img src="{{ asset('images/delete.svg') }}" alt="" class="scale-[1.2]">
                                            </button>
                                            <x-modals.message modal='popup-modal-delete{{$cb->id}}' :id='$cb->id' message='Elimina' :name='$cb->name' route='business.cabin.destroy'/>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready( function () {
                $('#cabinTable').DataTable({
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
