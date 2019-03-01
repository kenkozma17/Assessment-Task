<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Innoscript Project</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name='csrf-token' content='{{ csrf_token() }}' >
        <script>window.laravel = { csrfToken: '{{ csrf_token() }}'}</script>
        <link rel='stylesheet' href='{{ asset('css/app.css') }}' >
        <link rel='stylesheet' href='{{ asset('css/app.custom.css') }}' >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="{{ asset('css/datatable/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Nav Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id='navContainer'>
            <a class="navbar-brand" href="#"><b>Innoscripta Project</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/task/public">Bills List</a>
                </li>
                </ul>
            </div>
        </nav>
        <!-- Nav Bar -->

        <!-- Content Container -->
        <div class="content-wrapper">

            <!-- Content Header -->
            <section class="content-header">
                @yield('header')
            </section>
            <!-- Content Header -->

            <!-- Main content -->
            <div class='card'>
                <section class="content container-fluid">
                    <div id='app'>
                        @yield('content')
                    </div>
                </section>
            </div>
            <!-- Main content -->

        </div>
        <!-- Content Container -->

        <!-- Required JS  -->
        <script src='{{asset('js/app.js')}}'></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {

                // Initiate Datatable
                $('#data').DataTable();

                // Make validation messages fade out
                setTimeout(function() {
                    $('#successMsg').fadeOut('slow');
                    $('#alertMsg').fadeOut('slow');
                }, 3000);

                // Fetch values to edit from button data
                $('#EditBill').on('show.bs.modal', function (e){
                    var button      = $(e.relatedTarget);
                    var company_id  = button.data('company_id');
                    var date        = button.data('date');
                    var bill_amount = button.data('bill_amount');
                    var bill_no     = button.data('bill_no');

                    // Add fetched data to form
                    var modal = $(this);
                    modal.find('.modal-body #billDate').val(date)
                    modal.find('option[value="'+company_id+'"]').prop("selected", true);
                    modal.find('.modal-body #billAmount').val(bill_amount);
                    modal.find('.modal-body #billNo').val(bill_no);
                    modal.find('.modal-body #billID').val(bill_no);

                });
            });
        </script>
    </body>
</html>