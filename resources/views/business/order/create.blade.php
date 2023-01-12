<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="w-[calc(100%-256px)] h-[110px] py-[40px] px-[5%] bg-gray-100 fixed top-0 right-0 z-50 flex gap-10">
                <h1 class="text-[26px] font-bold">Nuovo Ordine</h1>
                <form action="" method="POST">
                    <input type="text" class="w-[500px] border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cerca prodotto..." id="search">
                </form>
            </div>

            <div class="flex relative pt-[60px]">
                <div class="w-1/2 bg-white px-5 py-3 shadow-lg">
                    <div id="products" class="flex flex-col gap-2 p-2 pb-4"/>
                </div>

                <div class="w-1/3 bg-white p-5 shadow-lg fixed top-[107px] right-[100px]">
                    <h3 class="text-[20px] font-bold mb-3">Riepilogo ordine</h3>
                    <form action="{{Route('business.order.store')}}" method="post">
                        @csrf

                        <div class="grow mb-2">
                            <x-input-label for="payment" :value="__('Modalità Pagamento*')" />
                            <select name="payment" id="payment" name="payment" class="w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option disabled selected value="">Seleziona</option>
                                <option value="contanti">contanti</option>
                                <option value="bonifico">bonifico</option>
                                <option value="rate">rate</option>
                            </select>
                            <x-input-error :messages="$errors->get('payment')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="notes" :value="__('inserisci note')" />
                            <textarea id="notes" name="notes" cols="30" rows="3" class="block mt-1 w-full rounded-md border-gray-500/30 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" :value="old('notes')" />
                            </textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        {{-- Prodoti inseriti --}}
                        <div class="border mt-6">
                            <div class="flex justify-between px-2 text-[15px] uppercase font-bold border-b shadow-sm">
                                <span class="flex justify-start item-center w-1/3">Prodotto</span>
                                <span class="flex justify-start item-center w-1/3">quantità</span>
                                <span class="flex justify-start item-center w-1/3">prezzo</span>
                            </div>
                            <div class="w-full h-[270px] overflow-y-auto">
                                <table class="w-full">
                                    <tbody id="cart"/>
                                </table>
                            </div>
                        </div>

                        <div class="w-full flex justify-between">
                            <div class="flex gap-3 items-center text-[18px] font-semibold my-3">
                                <h3>Prodotti inseriti:</h3>
                                <span id="count" class="font-medium text-[15px]"/>
                            </div>

                            <div class="text-[19px] font-bold mt-2">
                                <div class="min-w-[150px]">
                                    <span>Totale: </span>
                                    <span id="total"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 my-5">
                            <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>

                            <button type="submit" class="px-7 py-3 bg-[#6EA0FF] text-[13px] font-bold uppercase text-white hover:bg-[#85AFFD] tracking-[0.75px]">Invia ordine</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Info product --}}
            <div id="modal-info" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 z-50 h-full w-full bg-black/25">
                <div class="w-full h-full flex justify-center items-start">
                    <div class="bg-white flex justify-between items-end p-5 relative w-[650px] rounded-md mt-5">
                        <span class="chiudi absolute top-3 right-3 px-3 py-1 bg-[#E5EAEA] hover:bg-[#DCE2E2] text-[#6B7A88] font-bold uppercase tracking-[0.75px] cursor-pointer">
                            <i class="fa-solid fa-xmark text-[20px"></i>
                        </span>
                        <div class="w-full">
                            <h3 id="title" class="text-xl font-bold tracking-[0.75px] uppercase text-start mb-4">Info</h3>
                            <div id="modal-infoContent" class="w-full flex flex-col"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#search').on('keyup', function(){
                    search();
                });
                search();

                function search(){
                    var keyword = $('#search').val();
                    $.post('{{ route("business.product.search") }}',
                    {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        keyword:keyword
                    },
                    function(data){
                        productList(data);
                        info(data)
                    });
                };

                function productList(res){
                    let list = '';

                    if (res.products.length <= 0){
                        list+=` <span class="font-semibold text-[16px]">Nessun prodotto Trovato!</span>`;
                    };

                    for (let i = 0; i < res.products.length; i++){
                        list +=`
                            <div class="flex items-center justify-between border-b border-gray-500/20 shadow-sm pl-2 gap-2">
                                <div class="flex flex-col">
                                    <input type="checkbox" id="product-`+res.products[i].id+`" name="products[]" value="`+res.products[i].id+`" class="hidden">
                                    <div>
                                        <span class="capitalize text-[15px] font-semibold cursor-default">`+res.products[i].name+`</span>
                                        <i id="info" class="fa-solid fa-circle-info cursor-pointer ml-1"
                                            data-name="`+res.products[i].name+`"
                                            data-type="`+res.products[i].type+`"
                                            data-content="`+res.products[i].content+`"
                                            data-product_line="`+res.products[i].product_line+`"
                                            data-treatment="`+res.products[i].treatment+`"
                                            data-description="`+res.products[i].description+`">
                                        </i>
                                    </div>
                                    <span class="capitalize text-[14px] text-[#7E8D9B] font-medium cursor-default">Prezzo: € `+res.products[i].price+`</span>
                                </div>
                                <div class="flex items-end">
                                    <div class="flex flex-col items-start">
                                        <span class="text-[11px] font-extrabold text-[#ABB1B1] uppercase">Quantità</span>
                                        <div class="flex">
                                            <input type="number" id="qta-`+res.products[i].id+`" min="1" value="1" name="qta[]" placeholder="Pz." class="w-[100px] border-b-0 border-gray-500/20">
                                            <label for="product-`+res.products[i].id+`" id="add-`+res.products[i].id+`" data-id="`+res.products[i].id+`" data-name="`+res.products[i].name+`" data-price="`+res.products[i].price+`" class="add-to-cart px-7 py-3 bg-[#E5EAEA] text-[11px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Aggiungi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    };
                    document.querySelector('#products').innerHTML = list;
                };

                let ProductInfo = [];
                function info(res){
                    var info = '';
                    ProductInfo.forEach(element => {
                        console.log(ProductInfo);
                        info = `
                            <span>
                                <b>Tipo: </b>
                                `+element.type+`
                            </span>
                            <span>
                                <b>Contenuto: </b>
                                `+element.content+`
                            </span>
                            <span>
                                <b>Linea Prodotto: </b>
                                `+element.product_line+`
                            </span>
                            <span>
                                <b>Trattamento: </b>
                                `+element.treatment+`
                            </span>
                            <p>
                                <b>Descrizione: </b>
                                `+element.description+`
                            </p>
                        `;
                    });

                    document.querySelector('#modal-infoContent').innerHTML = info;
                }

                var cart = [];
                var qty = 0;

                function updateCart() {
                    var product = '';
                    var total = 0;
                    cart.forEach(element => {
                        // if (cart.filter(item => item.id == element.id).length > 0) {
                        //     // console.log(element.qty, cart.filter(item => item.qty));
                        //     var t = document.querySelector('#tot-'+element.id);
                        //     console.log(t);
                        //     // document.querySelector('#tot-'+element.id).innerHTML = '5'
                        // }
                        product +=
                        `<tr class='flex justify-between bg-[#E5EAEA] my-1 p-2 '>
                            <td class='flex justify-start item-center capitalize w-1/3'>`+element.name+`</td>
                            <td id="tot-`+element.id+`" class='flex justify-center item-center w-1/3 pr-8'>`+ element.qty +`</td>
                            <td class='flex justify-center item-center w-1/3'> € `+ new Intl.NumberFormat('de-DE', {currency: 'EUR', style: 'currency'}).format(element.price * element.qty) +`</td>
                            <td class="flex justify-center item-center">
                                <span id="remove-`+element.id+`" data-id="`+element.id+`" class='remove-to-cart flex justify-center item-center bg-red-500 px-3 py-[2px] rounded-md text-white cursor-pointer hover:brightness-90'>rimuovi</span>
                            </td>
                            <input checked type="checkbox" id="product-`+element.id+`" name="products[]" value="`+element.id+`" class="hidden">
                            <input type="number" id="qta-`+element.id+`" min="1" value="`+ element.qty +`" name="qta[]" placeholder="Pz." class="hidden">
                        </tr>
                        `;
                        total += element.price * element.qty;
                    });
                    document.querySelector('#cart').innerHTML = product;
                    document.querySelector('#count').innerHTML = cart.length;
                    document.querySelector('#total').innerHTML = new Intl.NumberFormat('de-DE', {currency: 'EUR', style: 'currency'}).format(total);
                };

                $(document).on('click', '.add-to-cart', function(event){
                    cart.push({'id':$(this).data('id'), 'name':$(this).data('name'), 'price':$(this).data('price'), 'qty':$(this).prev('input').val()});
                    // if (cart.filter((element) => element.id == $(this).data('id')).length < 1) {
                    // } else {
                    //     qty = $(this).prev('input').val();
                    // }
                    updateCart();
                });

                $(document).on('click', '.remove-to-cart', function(event){
                    cart = cart.filter((element) => element.id != $(this).data('id'));
                    updateCart();
                    document.querySelector('#product-'+$(this).data('id')).checked = false;
                });

                $(document).on('click', '#info', function(event){
                    ProductInfo.push({'name':$(this).data('name'),'type':$(this).data('type'), 'content':$(this).data('content'), 'product_line':$(this).data('product_line'), 'treatment':$(this).data('treatment'), 'description':$(this).data('description'),});
                    info();
                    document.querySelector('#modal-info').classList.remove('hidden');
                    document.querySelector('#title').innerHTML = $(this).data('name');
                });

                document.querySelector('.chiudi').addEventListener('click', e => {
                    document.querySelector('#modal-info').classList.toggle('hidden');
                });

            });
        </script>
    @endpush
</x-business-layout>


