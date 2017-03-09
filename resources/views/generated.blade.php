@extends('layouts.app')

@section('title', 'Dashboard')

@section('customCss')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/af-2.1.3/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/b-print-1.2.4/cr-1.3.2/fh-3.1.2/kt-2.2.0/r-2.1.0/rr-1.2.0/sc-1.4.2/se-1.2.0/datatables.min.css"/> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('dataTables/datatables.min.css') }}">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->transaction_id }}</td>
                                <td>{{ $invoice->customer_name }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>
                                    <a href="{{ action('InvoiceController@show', ['id' => $invoice->id]) }}" class="btn btn-xs btn-default">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                autoFill: true,
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            } );
        } );
    </script>
@stop
