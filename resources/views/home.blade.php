@extends('layouts.app')

@section('title', 'Dashboard')

@section('customCss')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/af-2.1.3/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/b-print-1.2.4/cr-1.3.2/fh-3.1.2/kt-2.2.0/r-2.1.0/rr-1.2.0/sc-1.4.2/se-1.2.0/datatables.min.css"/> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('dataTables/datatables.min.css') }}">
@stop

@section('content')
<div class="container">
    {{-- <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-1 col-md-offset-2"></div>
        <div class="col-md-2">
            <a href="{{ action('ProformaController@index') }}" class="btn btn-default btn-block">Generate Proforma</a>
        </div>
        @if (App\User::checkPermission('invoice'))
            <div class="col-md-2">
                <a href="#" class="btn btn-primary btn-block">Generate Invoice</a>
            </div>
        @endif
        @if (App\User::checkPermission('report'))
             <div class="col-md-2">
                <a href="#" class="btn btn-success btn-block">Generate Report</a>
            </div>
        @endif
    </div> --}}
    @if (App\User::checkRoot())
        <div class="row">
            <div class="col-md-6">
                <form action="{{ url('/getSaleDetails') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Transaction ID" name="transactionID">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Get" class="btn btn-default">
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                LATEST TRANSACTIONS
                @if (App\User::checkRoot())
                    <a href="{{ action('RequestController@makeRequest', ['baseUrl' => 'https://euroleague.acikgise.com']) }}" class="btn btn-success btn-xs pull-right">Refresh</a>
                    <a href="{{ action('RequestController@getDeskSales', ['baseUrl' => 'https://euroleague.acikgise.com']) }}" class="btn btn-warning btn-xs">Desk Sales</a>
                @endif
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Method</th>
                            <th>Customer Name</th>
                            <th>Channel</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            {{--@if (!\App\Invoice::checkGenerated($sale->transaction_id))--}}
                                <tr class="@if (App\Invoice::checkGenerated($sale->transaction_id))
                                            success
                                           @endif">
                                    <td>{{ $sale->transaction_id }}</td>
                                    <td>{{ $sale->payment_method }}</td>
                                    <?php $customer = \App\Customer::find($sale->customer_id)
                                            ?>
                                    <td>{{ $customer->first_name . ' ' . $customer->second_name }}</td>
                                    <td>{{ $sale->channel }}</td>
                                    <td>{{ $sale->time }}</td>
                                    <td>{{ $sale->transaction_type }}</td>
                                    <td>
                                        @if(App\User::checkPermission())
                                        <a href="{{ action('SalesController@edit', ['id' => $sale->id]) }}" class="btn btn-xs btn-default">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            {{--@endif--}}
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
