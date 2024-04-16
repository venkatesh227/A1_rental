<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin/css/pace.min.css') }}" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet" />
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet" />
    <title>A1</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        @include('admin.inc.header')

        @include('admin.inc.sidebar')

        <div class="content">
            @yield('content')
        </div>


        <!-- Bootstrap JS -->
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
        <!--plugins-->
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <!-- Vector map JavaScript -->
        <script src="{{ asset('admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('admin/plugins/chartjs/js/chart.js') }}"></script>
        <script src="{{ asset('admin/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('admin/js/index.js') }}"></script>
        <!--app JS-->
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>






        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
        <script>
            $(document).ready(function() {
                var table = $('#example2').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });
        </script>
</body>

</html>
