@extends('layouts.app')

@section('title', 'Desk Sales')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Remove Duplicates</th>
                </tr>
            </thead>
            <tbody>
                @foreach($desks as $sale)
                    <tr>
                        <td>{{ $sale->transaction_id }}</td>
                        <?php $customer = \App\Customer::find($sale->customer_id) ?>
                        <td>{{ $customer->first_name . $customer->second_name }}</td>
                        <td>
                            <a href="#" class="text-warning">Remove Duplicates</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop