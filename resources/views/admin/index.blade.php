<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link href="{{ asset('admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
        integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <title>A1</title>
</head>
<style>
    .dataTables_wrapper .dataTables_length {
      margin-right: 20px;
      /* margin-bottom: 60px; */
    }
  </style>
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



        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @if (session('status'))
            <script>
                swal("{{ session('status') }}");
            </script>
        @endif


        {{-- <script>
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
        </script> --}}
</body>

</html>
