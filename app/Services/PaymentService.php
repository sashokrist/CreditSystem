<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Payment;

class PaymentService
{
    public function makePayment(Loan $loan, $amount)
    {
        // Calculate the total amount paid for the loan
        $paid = $amount;
        // Calculate the remaining amount due for the loan
        $remainingAmount = $loan->amount;

        $current = $remainingAmount - $paid;

        // Check if the payment amount exceeds the remaining amount due
        if ($amount > $loan->amount) {
            $loan->amount = $remainingAmount - $paid;
            $loan->save();
            return false; // Payment exceeds the remaining amount due
        }

        // Create a payment record for the loan
        Payment::create([
            'loan_id' => $loan->id,
            'amount' => $amount,
        ]);

        $loan->amount = $current;
        $loan->save();

        return true; // Payment successful
    }
}
