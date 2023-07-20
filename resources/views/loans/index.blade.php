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
                        <h2 class="text-center">Кредити</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Кредит ID</th>
                                <th>Име на получателя</th>
                                <th>Сума (BGN)</th>
                                <th>Период (месеци)</th>
                                <th>Месечана лихва (BGN)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->borrower_name }}</td>
                                    <td>{{ $loan->amount }} лв.</td>
                                    <td>{{ $loan->term }}</td>
                                    <td>{{ $loanController->calculateMonthlyInstallment($loan->amount, $loan->term) }} лв.</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $loans->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 3000);
    </script>
@endsection
