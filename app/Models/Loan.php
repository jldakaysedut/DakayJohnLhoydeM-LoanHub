<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact',
        'address',            
        'loan_type_id',     
        'requirements_id',
        'requirement_submit_id', // Add the requirement_submit_id here
        'amount',
        'loan_status_id',
        'date',
    ];

    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }

    public function loanStatus()
    {
        return $this->belongsTo(LoanStatus::class);
    }

    // Add the relationship to RequirementSubmit
    public function requirementSubmit()
    {
        return $this->belongsTo(RequirementSubmit::class);
    }
}
