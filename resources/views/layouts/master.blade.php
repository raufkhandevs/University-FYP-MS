<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/imgs/fav-logo-main.png') }}" type="image/ico" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('meta')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/frontend/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/frontend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/frontend/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('assets/frontend/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- JS Switch -->
    <link href="{{ asset('assets/frontend/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('assets/frontend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('assets/frontend/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('assets/frontend/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Datatables -->

    <link href="{{ asset('assets/frontend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/frontend/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">

    @yield('styles')

    {{-- @livewireStyles --}}

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/frontend/vendors/toastr.js/toastr.min.css') }}">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('layouts.includes.asidebar')

            <!-- top navigation -->
            @include('layouts.includes.navbar')
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            @include('layouts.includes.footer')
            <!-- /footer content -->


        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('assets/frontend/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/toastr.js/toastr.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/frontend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- JS Switch -->
    <script src="{{ asset('assets/frontend/vendors/switchery/dist/switchery.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/frontend/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/frontend/vendors/nprogress/nprogress.js') }}"></script>
    <!-- jQuery Smart Wizard -->
    <script src="{{ asset('assets/frontend/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('assets/frontend/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('assets/frontend/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('assets/frontend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/frontend/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('assets/frontend/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('assets/frontend/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('assets/frontend/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/flot.curvedlines/curvedLines.js') }}"></script>

    <!-- DateJS -->
    <script src="{{ asset('assets/frontend/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/frontend/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('assets/frontend/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/frontend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}">
    </script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/frontend/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

    {{-- @livewireScripts --}}

    @yield('scripts')

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @if (session('success_message'))
        <script>
            toastr.success("", "{{ session('success_message') }}", {
                timeOut: 3000
            })
        </script>
    @endif
    @if (session('warning_message'))
        <script>
            toastr.warning("", "{{ session('warning_message') }}", {
                timeOut: 3000
            })
        </script>
    @endif

    @if (session('error_message'))
        <script>
            toastr.error("", "{{ session('error_message') }}", {
                timeOut: 3000
            })
        </script>
    @endif

</body>


</html>
