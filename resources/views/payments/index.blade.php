@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2>All Payments</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Credit Number</th>
                                <th>Borrower Name</th>
                                <th>Amount (BGN)</th>
                                <th>Term (months)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->loan->id }}</td>
                                    <td>{{ $payment->loan->borrower_name }}</td>
                                    <td>{{ $payment->loan->amount }}</td>
                                    <td>{{ $payment->loan->term }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
