<!DOCTYPE html>
<html lang="en">

@include('forntend.layouts.app.partials.head')

<body>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">

      @include('forntend.layouts.app.header')


       @yield('main')

    @include('forntend.layouts.app.bottom_bar')

    @include('forntend.layouts.app.footer')

    @include('forntend.layouts.app.partials.script')

    <script>
        @if(Session::has('msg'))

        let type = "{{ Session::get('type') }}";

        switch(type){
            case "success":
            toastr.success("{{ Session::get("msg") }}");
            break;
            case "info":
            toastr.info("{{ Session::get("msg") }}");
            break;
            case "danger":
            toastr.danger("{{ Session::get("msg") }}");
            break;
            case "warning":
            toastr.warning("{{ Session::get("msg") }}");
            break;
            case "dark":
            toastr.dark("{{ Session::get("msg") }}");
            break;


        }

       @endif
      </script>

</body>

</html>
