<?php

// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

// Add the PaymentService class

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the payments.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $payments = Payment::with('loan')->orderByDesc('created_at')->paginate(10);
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function createPayment()
    {
        $loans = Loan::all();
        return view('payments.create', compact('loans'));
    }

    /**
     * Store a newly created payment in storage.
     *
     * @param PaymentRequest $request
     * @return RedirectResponse
     */
    public function store(PaymentRequest $request)
    {
        try {
            $loan = Loan::findOrFail($request->loan_id);
        } catch (Throwable $e) {
            Log::critical($e->getMessage());
            return redirect()->back()->with('error', 'Loan not found.');
        }

        try {
            $paymentSuccessful = $this->paymentService->makePayment($loan, $request->amount);
            return redirect()->route('loans.index')
                ->with('success', 'Payment made successfully.');
        } catch (Throwable $e) {
            Log::critical($e->getMessage());
            return redirect()->back()->with('error', 'warning', 'The payment amount exceeds the remaining amount due. Only the amount owed has been withdrawn.');
        }
    }
}
