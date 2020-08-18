    <script src="{{ mix('js/app.js') }}"></script>
   
    <!-- <script src="{{ mix('js/laravel-echo.js') }}"></script> -->
   
    @yield('js')

    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    </script>
<!--     <script>
        
        Echo.channel('postBroadcast')
        .listen('PostCreated', (e) => {
            toastr.info(e.post['title']);
        });
    </script> -->