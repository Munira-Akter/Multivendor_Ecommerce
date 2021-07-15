<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.partials.style')

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    @include('admin.layouts.header')

  <!-- Left side column. contains the logo and sidebar -->

   @include('admin.layouts.menu')

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

	@yield('admin')

  </div>
  <!-- /.content-wrapper -->

  @include('admin.layouts.footer')

  <!-- Control Sidebar -->

  @include('admin.layouts.sidebar')

  <!-- /.control-sidebar -->

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


	@include('admin.layouts.partials.script')

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
