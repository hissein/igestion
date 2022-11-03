<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Point of Sale</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#new-order-modal" class="btn btn-primary shadow-md mr-2">New Order</a>
            <div class="pos-dropdown dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-feather="chevron-down"></i>
                    </span>
                </button>
                <div class="pos-dropdown__dropdown-menu dropdown-menu">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                                <span class="truncate">INV-0206020 - {{ $fakers[3]['users'][0]['name'] }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                                <span class="truncate">INV-0206022 - {{ $fakers[4]['users'][0]['name'] }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                                <span class="truncate">INV-0206021 - {{ $fakers[5]['users'][0]['name'] }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y grid grid-cols-12 gap-5 mt-5">

        <!-- BEGIN: Item List -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="lg:flex intro-y">
                <div class="relative">
                    <input type="text" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" wire:model.debounce.500ms="search" placeholder="Search item..."><i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-feather="search"></i>
                </div>
                <select class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
                    <option>Sort By</option>
                    <option>A to Z</option>
                    <option>Z to A</option>
                    <option>Lowest Price</option>
                    <option>Highest Price</option>
                </select>
            </div>
            <div class="grid grid-cols-12 gap-5 mt-5">
                <div wire:click="setCategory(null)" class="col-span-12 sm:col-span-4 2xl:col-span-3 box {{null === $selectCategory? 'bg-primary ' : ''}} p-5 cursor-pointer zoom-in">
                    <div class="font-medium text-base {{null === $selectCategory  ? 'text-white' : ''}}">Toutes les categories</div>
                    <div class="text-slate-500">{{count($categories)}} Categories</div>
                    <div class="text-slate-500">{{count(\App\Models\Product::all())}} Produits</div>
                </div>
                @foreach($categories as $key => $category)
                    <div wire:click="setCategory({{$category->id}})" class="col-span-12 sm:col-span-4 2xl:col-span-3 box {{$category->id === $selectCategory? 'bg-primary ' : ''}} p-5 cursor-pointer zoom-in">
                        <div class="font-medium text-base {{$category->id === $selectCategory  ? 'text-white' : ''}}">{{$category->name}}</div>
                        <div class="text-slate-500">{{count($category->products)}} Produit(s)</div>
                    </div>
                @endforeach

            </div>
            <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t">
                @foreach ($products as $product)

                    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 cursor-pointer"  data-tw-toggle="modal" data-tw-target="#add-item-modal" data-product-id="{{$product->id}}" data-product-stock="{{$product->stock}}" data-product-name="{{$product->name}}" data-product-sale>
                        <div class="box zoom-in">
                            <div class="p-5">
                                <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                                    <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{asset($product->assets[0]->name)}}">
                                    <span class="absolute top-0 bg-pending text-white text-xs m-5 px-2 py-1 p-4 rounded z-10">Featured</span>
                                    <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                        <a href="" class="block font-medium text-base">{{$product->name}}</a>
                                        <span class="text-white/90 text-xs mt-3">{{$product->category->name}}</span>
                                    </div>
                                </div>
                                <div class="text-slate-600 dark:text-slate-500 mt-5"  >
                                    <div class="flex items-center"  >
                                        <i data-feather="link" class="w-4 h-4 text-slate-500 mr-2"></i>
                                        price: {{MoneyFormat::format_money($product->price)}}
                                    </div>
                                    <div class="flex items-center mt-2" >
                                        <i data-feather="layers" class="w-4 h-4 text-slate-500 mr-2"></i>
                                        En stock: {{$product->stock}}
                                    </div>
                                    <div class="flex items-center mt-2 " >
                                        <i data-feather="edit" class="w-4 h-4 text-slate-500 mr-2 "></i>
                                        Status: <span class="{{!$product->status ? 'text-danger' : 'text-success'}} ml-1">{{$product->status ? 'Active' : 'Desactiver'}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <!-- END: Item List -->
        <!-- BEGIN: Ticket -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <ul class="nav nav-pills" role="tablist">
                        <li id="ticket-tab" class="nav-item flex-1" role="presentation">
                            <button
                                class="nav-link w-full py-2 active"
                                data-tw-toggle="pill"
                                data-tw-target="#ticket"
                                type="button"
                                role="tab"
                                aria-controls="ticket"
                                aria-selected="true"
                            >
                                Ticket
                            </button>
                        </li>
                        <li id="details-tab" class="nav-item flex-1" role="presentation">
                            <button
                                class="nav-link w-full py-2"
                                data-tw-toggle="pill"
                                data-tw-target="#details"
                                type="button"
                                role="tab"
                                aria-controls="details"
                                aria-selected="false"
                            >
                                Details
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="ticket" class="tab-pane active" role="tabpanel" aria-labelledby="ticket-tab">
                    <div class="box p-2 mt-5">
                        @if(count($salProducts)> 0)
                            @foreach ($salProducts as $key => $salProduct)

                                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                                    <button class=" btn btn-sm btn-danger mr-2 "   wire:click.stop="removeSaleItem({{$salProduct->product->id}})">
                                        <i data-feather="trash" class="w-5 h-5 tooltip" title="Retierr le produit"></i>
                                    </button>
                                    <div class="max-w-[50%] truncate mr-1">{{ $salProduct->product->name }}</div>
                                    <div class="text-slate-500">x {{$salProduct->qty}}</div>
                                    <div ><i data-feather="edit" class="w-4 h-4 text-slate-500 ml-2"></i></div>
                                    <div class="ml-auto font-medium">{{ MoneyFormat::format_money($salProduct->total) }}</div>
                                </a>
                            @endforeach
                        @else
                            <span class="text-slate-600 dark:text-slate-500 block text-center p-4">Auccun produit dan sle panier</span>
                        @endif
                    </div>
                    <div class="box flex p-5 mt-5">
                        <input type="text" class="form-control py-3 px-4 w-full bg-slate-100 border-slate-200/60 pr-10" placeholder="Use coupon code...">
                        <button class="btn btn-primary ml-2">Apply</button>
                    </div>
                    <div class="box p-5 mt-5">
                        <div class="flex">
                            <div class="mr-auto">Total</div>
                            <div class="font-medium">{{MoneyFormat::format_money($total)}}</div>
                        </div>
                        <div class="flex mt-4">
                            <div class="mr-auto">Remise</div>
                            <div class="font-medium text-danger">{{$discount}}%</div>
                        </div>
                        <div class="flex mt-4">
                            <div class="mr-auto">Tax</div>
                            <div class="font-medium">{{$tax}}%</div>
                        </div>
                        <div class="flex mt-4 pt-4 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="mr-auto font-medium text-base">Total Charge</div>
                            <div class="font-medium text-base">{{MoneyFormat::format_money($finalPrice)}}</div>
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <button wire:click="clearSal" class="btn w-32 border-slate-300 dark:border-darkmode-400 text-slate-500">Clear Items</button>
                        <button class="btn btn-primary w-32 shadow-md ml-auto">Charge</button>
                    </div>
                </div>
                <div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details-tab">
                    <div class="box p-5 mt-5">
                        <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-5">
                            <div>
                                <div class="text-slate-500">Time</div>
                                <div class="mt-1">02/06/20 02:10 PM</div>
                            </div>
                            <i data-feather="clock" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                        <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 py-5">
                            <div>
                                <div class="text-slate-500">Customer</div>
                                <div class="mt-1">{{ $fakers[0]['users'][0]['name'] }}</div>
                            </div>
                            <i data-feather="user" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                        <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 py-5">
                            <div>
                                <div class="text-slate-500">People</div>
                                <div class="mt-1">3</div>
                            </div>
                            <i data-feather="users" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                        <div class="flex items-center pt-5">
                            <div>
                                <div class="text-slate-500">Table</div>
                                <div class="mt-1">21</div>
                            </div>
                            <i data-feather="mic" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Ticket -->
    </div>
    <div class="mt-8">
        {{$products->links()}}
    </div>
    <!-- BEGIN: New Order Modal -->
    <div id="new-order-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">New Order</h2>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="pos-form-1" class="form-label">Name</label>
                        <input id="pos-form-1" type="text" class="form-control flex-1" placeholder="Customer name">
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-2" class="form-label">Table</label>
                        <input id="pos-form-2" type="text" class="form-control flex-1" placeholder="Customer table">
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-3" class="form-label">Number of People</label>
                        <input id="pos-form-3" type="text" class="form-control flex-1" placeholder="People">
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-32">Create Ticket</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: New Order Modal -->
    <!-- BEGIN: Add Item Modal -->
    <div id="add-item-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto"></h2>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="pos-form-4" class="form-label">Quantity(Stock: )</label>
                        <div class="flex mt-2 flex-1">
                            <button type="button" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 mr-1" disabled>-</button>
                            <input id="qty" type="number" min="1" class="form-control w-24 text-center" data-product-count placeholder="Item quantity" value="2">
                            <button type="button" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 ml-1">+</button>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-5" class="form-label">Notes</label>
                        <textarea id="pos-form-5" class="form-control w-full mt-2" placeholder="Item notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button type="button" data-add-sale data-tw-dismiss="modal" class="btn btn-primary w-24">Add Item</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Add Item Modal -->
</div>

@section('script')
    @parent
    <script>
        const products = document.querySelectorAll('[data-product-sale]')
        const modal  = document.querySelector('#add-item-modal')

        products.forEach((el)=>{
            el.addEventListener('click', (e)=>{
                modal.querySelector('h2').innerText = el.getAttribute('data-product-name')
                modal.querySelector('input').setAttribute('max', el.getAttribute('data-product-stock'))
                modal.querySelector('label').innerText = `Quantity(Stock: ${ el.getAttribute('data-product-stock')} )`
                modal.setAttribute('product-id', el.getAttribute('data-product-id'))
               setTimeout(()=>{
                   const modals = document.querySelectorAll('.show')
                   modals.forEach((el)=>{
                       if (el.querySelector('h2').innerText  === ''){
                           console.log(el)
                           el.remove();
                       }
                   })
               },300)


            })
        })
        const submitAddSale = modal.querySelector('[data-add-sale]')
        submitAddSale.addEventListener('click', (e)=>{
          const product =parseInt( modal.getAttribute('product-id'))
            const qty = parseInt(modal.querySelector('input').value)
            const note = $(modal.querySelector('textarea')).val()
            const data = {"id": product, "qty": qty, 'note': note}
            Livewire.emit('addSaleItem', data)
            modal.removeAttribute('product-id')
            modal.querySelector("textarea").innerHTML = ''
            modal.querySelector("textarea").innerText = ''

        })
        const addButton = modal.querySelector('.ml-1')
        const substractButton = modal.querySelector('.mr-1')
        const inputCount = modal.querySelector('input')
        inputCount.addEventListener('change', (e)=>{
            handleInputCountChange()

        })
        substractButton.addEventListener('click', (e)=>{
           inputCount.value = `${(isNaN(parseInt(inputCount.value)) ? 2 : parseInt(inputCount.value)) - 1}`;
            handleInputCountChange()

        })
            addButton.addEventListener('click', (e)=>{
           inputCount.value =  `${(isNaN(parseInt(inputCount.value)) ? 0 : parseInt(inputCount.value)) + 1}`;
                handleInputCountChange()
        })


        function handleInputCountChange(){
            const d = parseInt(inputCount.value)
            if(d===1){
                substractButton.disabled = true;
                addButton.disabled = false;
            }else if (d === parseInt(inputCount.getAttribute("max"))) {
                addButton.disabled = true;
                substractButton.disabled =false;
            }else {
                addButton.disabled =false;
                substractButton.disabled =false;
            }
        }
    </script>

@endsection
