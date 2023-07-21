<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['borrower_name', 'amount', 'term'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'loan_id');
    }
}
