<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail Pinjaman</title>
     <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.min.css') }}">
    
     <link rel="stylesheet" href="{{asset('css/custom.css') }}">
     <link rel="stylesheet" href="{{asset('css/cetak.css') }}">


</head>
{{-- <body > --}}
    <body onload="window.print();">


    <div class="content-wrapper simulasi-page">
        @yield('content')
    </div>    

<script src="{{asset('lte/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{asset('lte/dist/js/adminlte.js') }}"></script>

<script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('lte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{asset('js/data_table.js') }}"></script>
<script src="{{asset('js/custom.js') }}"></script>

</body>
</html>