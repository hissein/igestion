@extends('../layout/' . $layout)

@section('subhead')
    <title>Tabulator - Tinker - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="col-span-12 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Weekly Top Products</h2>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{route("admin.product.create")}}" class="btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel
                </a>
                <button class="ml-3 btn box flex items-center text-slate-600 dark:text-slate-300">
                    <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF
                </button>
            </div>
        </div>
        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
            <table class="table table-report sm:mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">IMAGES</th>
                    <th class="whitespace-nowrap">PRODUCT NAME</th>
                    <th class="text-center whitespace-nowrap">PRICE</th>
                    <th class="text-center whitespace-nowrap">STOCK</th>
                    <th class="text-center whitespace-nowrap">STOCK ALERT</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                @foreach($product->assets as $asset)
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Tinker Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{asset($asset->name)}}" title="Uploaded at">
                                    </div>
                                @endforeach


                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $product->name }}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $product->category->name }}</div>
                        </td>
                        <td class="text-center ">{{MoneyFormat::format_money($product->price ) }}</td>
                        <td class="text-center {{$product->stock > $product->stock_defective? '' : 'text-danger' }}">{{ $product->stock }}</td>
                        <td class="text-center">{{ $product->stock_defective }}</td>
                        <td class="w-40">
                            <div class="flex items-center justify-center {{ $product->status ? 'text-success' : 'text-danger' }}">
                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $product->status  ? 'Active' : 'Inactive' }}
                            </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="flex items-center text-danger" href="">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-feather="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-feather="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-feather="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-feather="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
    </div>
@endsection
