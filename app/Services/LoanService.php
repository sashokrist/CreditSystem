<?php

// app/Services/LoanService.php

namespace App\Services;

class LoanService
{
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
}
