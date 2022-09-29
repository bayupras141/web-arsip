<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('backend/img/favicon.png')}}" rel="icon" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('backend/css/datatables-bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css">
    <link href="{{asset('backend/vendor/bootstrap-fileinput-master/css/fileinput.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendor/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendor/select2/select2-bootstrap.min.css')}}" rel="stylesheet">
    {{-- font awesome picker --}}
    <link href="{{asset('backend/vendor/fontawesome-iconpicker/fontawesome-iconpicker.min.css')}}" rel="stylesheet">


    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput-master/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput-master/js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput-master/themes/fa/theme.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput-master/js/locales/id.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}" type="text/javascript"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/jquery-datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/datatables-bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/select2/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/fontawesome-iconpicker/fontawesome-iconpicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/dist/pspdfkit.js')}}"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                        @yield('content')
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layouts.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        {{-- <i class="fas fa-angle-up"></i> --}}
    </a>

    
    @stack('scripts')
</body>
</html>