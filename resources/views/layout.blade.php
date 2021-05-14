<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel BBB</title>

    {{-- <!-- Font Awesome --> --}}
    <link rel="stylesheet" href="{{ asset('assets/lte3/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <!-- Ionicons --> --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <!-- DataTables --> --}}
    <link rel="stylesheet" href="{{ asset('assets/lte3/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    {{-- <!-- Theme style --> --}}
    <link rel="stylesheet" href="{{ asset('assets/lte3/dist/css/adminlte.min.css') }}">
    {{-- <!-- Google Font: Source Sans Pro --> --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    {{-- <!-- daterange picker --> --}}
    <link rel="stylesheet" href="{{ asset('assets/lte3/plugins/daterangepicker/daterangepicker.css') }}">
    {{-- <!-- Tempusdominus Bootstrap 4 --> --}}
    <link rel="stylesheet"
        href="{{ asset('assets/lte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    {{-- <!-- Bootstrap Color Picker --> --}}
    <link rel="stylesheet"
        href="{{ asset('assets/lte3/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    {{-- <!-- Select2 --> --}}
    <link rel="stylesheet" href="{{ asset('assets/lte3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/lte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    {{-- <!-- Bootstrap4 Duallistbox --> --}}
    <link rel="stylesheet"
        href="{{ asset('assets/lte3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">






</head>

<body>
    @include('header')

    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('assets/lte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/lte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets/lte3/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- AdminLTE App -->
    <!-- InputMask -->
    <script src="{{ asset('assets/lte3/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lte3/dist/js/adminlte.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/lte3/plugins/daterangepicker/daterangepicker.js') }}"></script>



    <script>
        $(function() {
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Ultimos 7 días': [moment().subtract(6, 'days'), moment()],
                        'Ultimos 30 días': [moment().subtract(29, 'days'), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(
                            1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()

                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }

            )
        })

    </script>
    <script>
        $(function() {
            $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });

    </script>

</body>

</html>
