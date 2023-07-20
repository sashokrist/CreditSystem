<?php

// app/Services/LoanService.php

namespace App\Services;

use App\Models\Loan;

class LoanService
{
    /**
     * Calculate the monthly installment amount for a loan
     *
     * @param $loanAmount
     * @param $loanTerm
     * @return float|int|string
     */
    public function calculateMonthlyInstallment($loanAmount, $loanTerm)
    {
        $annualInterestRate = 0.079; // 7.9% annual interest rate
        $monthlyInterestRate = $annualInterestRate / 12; // Convert annual interest rate to monthly interest rate

        $denominator = 1 - pow(1 + $monthlyInterestRate, -$loanTerm);

        // Check if the denominator is zero (infinite installment amount) to avoid division by zero
        if ($denominator === 0) {
            return 'N/A';
        }

        $monthlyInstallment = ($loanAmount * $monthlyInterestRate) / $denominator;
        return round($monthlyInstallment, 2); // Round to 2 decimal places
    }

    /**
     * Check if the total amount of loans for the borrower exceeds BGN 80,000
     *
     * @param $borrowerName
     * @param $loanAmount
     * @return bool
     */
    public function checkTotalLoansAmount($borrowerName, $loanAmount)
    {
        $totalAmountLoans = Loan::where('borrower_name', $borrowerName)->sum('amount');

        return $totalAmountLoans + $loanAmount <= 80000;
    }
}
