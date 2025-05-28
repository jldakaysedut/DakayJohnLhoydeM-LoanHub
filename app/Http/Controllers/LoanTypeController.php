<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanType;

class LoanTypeController extends Controller
{
    public function getLoanTypes()
    {
        $loanTypes = LoanType::all();
        return response()->json(['loanTypes' => $loanTypes]);
    }

    public function addLoanType(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:loan_types'],
        ]);

        $loanType = LoanType::create(['name' => $request->name]);

        return response()->json(['message' => 'Loan type successfully created!', 'loanType' => $loanType]);
    }

    public function deleteLoanType($id)
    {
        $loanType = LoanType::find($id);
        if (!$loanType) {
            return response()->json(['message' => 'Loan type not found!'], 404);
        }

        $loanType->delete();
        return response()->json(['message' => 'Loan type successfully deleted!']);
    }

    public function editLoanType(Request $request, $id)
    {
        $loanType = LoanType::find($id);
        if (!$loanType) {
            return response()->json(['message' => 'Loan type not found!'], 404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:loan_types,name,' . $id],
        ]);

        $loanType->update($request->all());
        return response()->json(['message' => 'Loan type updated successfully!', 'loanType' => $loanType]);
    }
}