<?php

// app/Http/Controllers/LoanController.php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Services\LoanService;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Payment;

class LoanController extends Controller
{
    private $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $loans = Loan::orderByDesc('created_at')->paginate(10);
        $loanController = $this; // Pass the controller instance to the view
        return view('loans.index', compact('loans', 'loanController'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(LoanRequest $request)
    {
        // Check if the total amount of loans for the borrower exceeds BGN 80,000
        try {
            $isTotalLoansAmountValid = $this->loanService->checkTotalLoansAmount($request->borrower_name, $request->amount);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The total amount of loans for this borrower exceeds BGN 80,000.');
        }

        $loan = Loan::create($request->all());

        return redirect()->route('loans.index')
            ->with('success', 'Loan created successfully.');
    }

    public function calculateMonthlyInstallment($loanAmount, $loanTerm)
    {
        return $this->loanService->calculateMonthlyInstallment($loanAmount, $loanTerm);
    }
}
