@extends('../layout/base')

@section('body')
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7gNHAhDzgYmq4-EHvM4bqW1DNj2UCuk&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
        @livewireScripts
        <script>
            Livewire.hook('message.processed', (message, component) => {
            window.feather.replace()
            })
        </script>
        @yield('script')


    </body>
@endsection
