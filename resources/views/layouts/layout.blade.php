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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
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
</head>

<body class="hold-transition skin-green layout-top-nav">
    <div class="wrapper">

        @include('layouts.common.header')

        <div class="content-wrapper">
            <div class="container">

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
    </div>

    @include('layouts.common.footer')

    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.min.js')}}"></script>

    <script>
        var baseUrl = '{{url('/')}}';
        function ckDelete(){
            var check = confirm('Are you sure delete this?');
            if(check){
                return true;
            }else{
                return false;
            }
        }

        function ckAccept(){
            var check = confirm('Are you sure accept this?');
            if(check){
                return true;
            }else{
                return false;
            }
        }

        function ckReject(){
            var check = confirm('Are you sure reject this?');
            if(check){
                return true;
            }else{
                return false;
            }
        }

        function PrintInvoice(elem){
            var invoice_print = document.getElementById('invoice_print');
            invoice_print.style.visibility='hidden';

            var mywindow = window.open('', 'printwindow');
            mywindow.document.write('<html><head><title>Invoice</title>' +
                '<link rel="stylesheet" type="text/css" href="'+baseUrl+'/css/AdminLTE.min.css" />' +
                '<link rel="stylesheet" type="text/css" href="'+baseUrl+'/bower_components/bootstrap/dist/css/bootstrap.min.css" />');
            mywindow.document.write('</head><body>');
            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');
            setTimeout(function () {
                mywindow.print();
                mywindow.close();
                invoice_print.style.visibility='visible';
            }, 500);
            return true;
        }

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


        });
    </script>

</body>
</html>
