<?php use App\Models\Cart;
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A1 Rental</title>
    <link rel=icon href="assets/img/favicon.png" sizes="20x20" type="image/png">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="{{ asset('fronted/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('fronted/css/style.css') }}">
    <style>
        /* CSS to style search form */
        .search-form {
            margin-top: 10px;
            /* Adjust as needed */
        }

        /* CSS to style search input and icon */
        .input-group {
            position: relative;
            width: 100%;
        }

        .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-append {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
        }

        .submit-btn {
            background-color: #fff;
            border: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>


</head>

<body>

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->


    <div class="body-overlay" id="body-overlay"></div>

    <!-- navbar start -->
    @include('frontend.inc.navbar')
    <!-- navbar end -->
    <div class="content">
        @yield('content')
    </div>



    <!-- Footer Starts -->
    @include('frontend.inc.footer')
    <!-- Footer End -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->


    <!-- all plugins here -->
    <script src="{{ asset('fronted/js/vendor.js') }}"></script>

    <!-- main js  -->
    <script src="{{ asset('fronted/js/main.js') }}"></script>
    <script src="{{ asset('fronted/js/custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        var availableTags = [];
        $.ajax({
            type: "GET",
            url: "/product-list",
            success: function(response) {
               
                availableTags = response; // Store response in availableTags array
                startAutoComplete(); // Call startAutoComplete function after getting the response
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    
        function startAutoComplete() {
            $("#search-product").autocomplete({
                source: availableTags
            });
        }
    </script>
    

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif


    @yield('scripts')
</body>

</html>
