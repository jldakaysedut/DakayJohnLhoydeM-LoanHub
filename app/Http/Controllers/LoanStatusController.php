<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanStatus;

class LoanStatusController extends Controller
{
    public function getLoanStatuses()
    {
        $loanStatuses = LoanStatus::all();
        return response()->json(['loanStatuses' => $loanStatuses]);
    }

    public function addLoanStatus(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:loan_statuses'],
        ]);

        $loanStatus = LoanStatus::create(['name' => $request->name]);

        return response()->json(['message' => 'Loan status successfully created!', 'loanStatus' => $loanStatus]);
    }

    public function deleteLoanStatus($id)
    {
        $loanStatus = LoanStatus::find($id);
        if (!$loanStatus) {
            return response()->json(['message' => 'Loan status not found!'], 404);
        }

        $loanStatus->delete();
        return response()->json(['message' => 'Loan status successfully deleted!']);
    }

    public function editLoanStatus(Request $request, $id)
    {
        $loanStatus = LoanStatus::find($id);
        if (!$loanStatus) {
            return response()->json(['message' => 'Loan status not found!'], 404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:loan_statuses,name,' . $id],
        ]);

        $loanStatus->update($request->all());
        return response()->json(['message' => 'Loan status updated successfully!', 'loanStatus' => $loanStatus]);
    }
}