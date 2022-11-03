@extends('../layout/' . $layout)

@section('subhead')
    <title>Ajouter un produit</title>
@endsection

@section('subcontent')

    <!-- BEGIN: Notification Content -->
    <div id="basic-non-sticky-notification-content" class="toastify-content hidden flex">
        <div class="font-medium">Votre Produit a ete creer avec success</div>
        <a class="font-medium text-primary dark:text-slate-400 mt-1 sm:mt-0 sm:ml-40" href="">Voir</a>
    </div>
    <!-- END: Notification Content -->
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Ajouter un produit</h2>
    </div>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Display Information</h2>
                </div>
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form action="{{route('admin.product.post')}}" id="create_product" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="file" style="display: none" name="files" id="files"/>

                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div>
                                            <label for="name" class="form-label">Nom du produit</label>
                                            <input id="name" type="text" name="name" class="form-control" placeholder="Nom du produit" required >
                                        </div>
                                        <div class="mt-3">
                                            <label for="category_id" class="form-label">Categories</label>
                                            <select id="category_id" name="category_id" data-search="true" class="tom-select w-full">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="price" class="form-label">Prix</label>
                                            <div class="input-group mt-2">

                                                <div class="input-group-text">CFA</div>
                                                <input type="text" class="form-control" placeholder="Price" id="price"  name="price" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-text">.00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6">


                                        <div class="">
                                            <label for="stock" class="form-label">Stock</label>

                                            <input type="number" min="1" class="form-control" placeholder="Stock"  name="stock" aria-label="Produit en stock">

                                        </div>
                                        <div class="mt-3">
                                            <label for="stock_defective" class="form-label">Stock Alert</label>

                                            <input type="number" min="10" class="form-control" placeholder="stock alert"  name="stock_defective" aria-label="Produit en stock">

                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-12">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Description</label>

                                            <div class="editor" id="description">
                                                <p>Content of the editor.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-12">
                                        <div class="mt-3">
                                            <label >Image de produit</label>
                                            <div action="/file-upload" data-dropzone class="dropzone mt-2">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple/>
                                                </div>
                                                <div class="dz-message" data-dz-message>
                                                    <div class="text-lg font-medium">Drop files here or click to upload.</div>
                                                    <div class="text-slate-500">
                                                        This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label>Active</label>
                                            <div class="mt-2">
                                                <div class="form-check form-switch">
                                                    <input id="checkbox-switch-7" name="status" class="form-check-input" type="checkbox">
                                                    <label class="form-check-label"  for="checkbox-switch-7">Activer le produit</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="btn-create" class="btn btn-primary w-20 mt-3">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
@endsection
@section('script')
    @parent
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>

    <script>
        (function () {
            async function login() {

                // Post form


                // Loading state
                $('#btn-create').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)
                const form = document.querySelector("#create_product")
                const url = form.getAttribute("action")
                let formData = new FormData(form)
                const data = Object.fromEntries(formData)

                axios.post(url, formData, {
                    'Content-Type': 'multipart/form-data'
                }).then(res => {
                    if (res.status === 201){

                        window.toastify({
                            node: $("#basic-non-sticky-notification-content")
                                .clone()
                                .removeClass("hidden")[0],
                            duration: 600,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "white",
                            onClose: function () {
                                debugger
                                window.href="/products"
                            },
                            stopOnFocus: true,
                        }).showToast();
                        setTimeout(()=>{
                            window.location.href = '/'
                        },650)
                    }          }).catch(err => {
                        console.log(err)
                    debugger
                    window.toastify({
                        node: $("#basic-non-sticky-notification-content")
                            .clone()
                            .removeClass("hidden")[0],
                        duration: -1,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "white",
                        stopOnFocus: true,
                        onClose: function () {
                            debugger
                            window.href="/products"
                        }
                    }).showToast();
                    $('#btn-create').html('Ajouter')
                })
            }



            $('#create_product').on('submit',  function(e) {
                e.preventDefault()
                login()
            })
        })()
        function getFormData(dom_query){
            const out = {};
            const s_data = $(dom_query).serializeArray();
            //transform into simple data/value object
            for(let i = 0; i<s_data.length; i++){
                const record = s_data[i];
                out[record.name] = record.value;
            }
            return out;
        }
        const dropzone = document.querySelector("[data-dropzone]")
        const files = document.querySelector("#files")
        window.dropZoneInit(dropzone,function (file) {

            const dataTransfer = new DataTransfer();
            Array.from(files.files).forEach(el =>{
                dataTransfer.items.add(el)
            })
            dataTransfer.items.add(file)
            files.files = dataTransfer.files
        })
    </script>

@endsection
