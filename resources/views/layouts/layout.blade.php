<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AFC LAB') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/sweetalert2.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .breadcrumb{
            margin-bottom: 0px!important;
            font-size: 18px!important;
            border-radius: 0px!important;
            background-color: #ffffff!important;
        }
        .breadcrumb-btn {
            float: right!important;
            position: absolute;
            right: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 0px !important;
        }

        .box{
            border: none!important;
            border-radius: 0px!important;
            padding: 0px!important;
            box-shadow: none!important;
        }
        .content-wrapper {
            min-height: 100%;
            background-color: #ffffff!important;
            z-index: 800;
        }
        .skin-black-light .main-header>.logo{
            border-right: none!important;
        }

        .swal2-confirm.btn.btn-success{margin-right: 5px!important;}

.skin-black-light .main-header .navbar .navbar-custom-menu .navbar-nav>li>a, .skin-black-light .main-header .navbar .navbar-right>li>a{
    border-left: none;
}
.skin-black-light .main-header .navbar>.sidebar-toggle{
    border-right: none;
}
.content{font-size: 12px;}
.breadcrumb{
    margin-bottom: 0px!important;
    font-size: 16px!important;
    border-radius: 0px!important;
    background-color: #ffffff!important;
    padding: 6px 0px !important;
}
.breadcrumb-btn {
    float: right!important;
    position: absolute;
    right: 15px;
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 0px !important;
}

.box{
    border: none!important;
    border-radius: 0px!important;
    padding: 0px!important;
    box-shadow: none!important;
    margin-top: 10px!important;
}
.content-wrapper {
    min-height: 100%;
    background-color: #ffffff!important;
    z-index: 800;
}
.skin-black-light .main-header>.logo{
    border-right: none!important;
}


.skin-blue-light .sidebar-menu > li:hover > a, .skin-blue-light .sidebar-menu > li.active > a, .skin-blue-light .sidebar-menu > li.menu-open > a{
    color: #ffffff!important;
    background: #3b8dbc!important;
}
.skin-blue-light .sidebar-menu > li > .treeview-menu{
    background: #519cc7!important;
}
.skin-blue-light .sidebar-menu .treeview-menu > li > a {
    color: #ffffff!important;
}
.skin-blue-light .sidebar-menu .treeview-menu > li > a.active {
    color: #000!important;
    font-weight: bolder;
}

.swal2-confirm.btn.btn-success{margin-right: 5px!important;}
        .skin-blue-light .sidebar-menu > li:hover > a, .skin-blue-light .sidebar-menu > li.active > a, .skin-blue-light .sidebar-menu > li.menu-open > a{
            color: #ffffff!important;
            background: #3b8dbc!important;
        }
        .skin-blue-light .sidebar-menu > li > .treeview-menu{
            background: #519cc7!important;
        }
        .skin-blue-light .sidebar-menu .treeview-menu > li > a {
            color: #ffffff!important;
        }
        .skin-blue-light .sidebar-menu .treeview-menu > li > a.active {
            color: #000!important;
            font-weight: bolder;
        }
    </style>
</head>

<body class="skin-blue-light sidebar-mini fixed">
    <div class="wrapper">


        @include('layouts.common.header_new')

        @include('layouts.common.sidebar')

        <div class="content-wrapper">
            <div class="content">

                @if(Session('msg_success'))
                    <div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom: 0px!important; margin-top: 10px!important;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> {{Session('msg_success')}}
                    </div>
                @endif

                @if(Session('msg_error'))
                    <div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0px!important; margin-top: 10px!important;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> {{Session('msg_error')}}
                    </div>
                @endif

                @yield('content')

            </div>
        </div>

        @include('layouts.common.footer')
    </div>

    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.min.js')}}"></script>
    <!-- fullCalendar -->
    <script src="{{asset('bower_components/moment/moment.js')}}"></script>
    <script src="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>

    <script src="{{asset('js/sweetalert2.js')}}"></script>

    @yield('script')

    <script>
        var baseUrl = '{{url('/')}}';

        function confirmAction(btn, message, url){
            swal({
                title: message,
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#c82333',
                confirmButtonText: 'Yes, '+btn+' it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                console.log(url);
                window.location.href=url;
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'your stuff is safe.',
                        'error'
                    )
                }
            })
        }


        function confirmDelete(btn, message, id){
            swal({
                title: message,
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#c82333',
                confirmButtonText: 'Yes, '+btn+' it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                console.log(id);
                document.getElementById(id).submit();
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'your stuff is safe.',
                        'error'
                    )
                }
            })
        }

//        function PrintInvoice(elem){
//            var invoice_print = document.getElementById('invoice_print');
//            invoice_print.style.visibility='hidden';
//
//            var mywindow = window.open('', 'printwindow');
//            mywindow.document.write('<html><head><title>Invoice</title>' +
//                '<link rel="stylesheet" type="text/css" href="'+baseUrl+'/css/AdminLTE.min.css" />' +
//                '<link rel="stylesheet" type="text/css" href="'+baseUrl+'/bower_components/bootstrap/dist/css/bootstrap.min.css" />');
//            mywindow.document.write('</head><body>');
//            mywindow.document.write(document.getElementById(elem).innerHTML);
//            mywindow.document.write('</body></html>');
//            setTimeout(function () {
//                mywindow.print();
//                mywindow.close();
//                invoice_print.style.visibility='visible';
//            }, 500);
//            return true;
//        }

        $(function () {
            $('#example1').DataTable();
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });

//            $('.timepicker').timepicker();

            $('.select2').select2();

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })
        });
    </script>

</body>
</html>
