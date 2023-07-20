<!-- resources/views/loans/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2>Create New Loan</h2>
                        <form action="{{ route('loans.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="borrower_name">Borrower Name:</label>
                                <input type="text" class="form-control" id="borrower_name" name="borrower_name" required>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount (BGN):</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="term">Term (months):</label>
                                <input type="number" class="form-control" id="term" name="term" min="3" max="120" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
