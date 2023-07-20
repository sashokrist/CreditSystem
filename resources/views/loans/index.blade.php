@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
                        <h2>All Credits</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Loan ID</th>
                                <th>Borrower Name</th>
                                <th>Amount (BGN)</th>
                                <th>Term (months)</th>
                                <th>Monthly Installment (BGN)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->borrower_name }}</td>
                                    <td>{{ $loan->amount }}</td>
                                    <td>{{ $loan->term }}</td>
                                    <td>{{ $loanController->calculateMonthlyInstallment($loan->amount, $loan->term) }}</td>
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
