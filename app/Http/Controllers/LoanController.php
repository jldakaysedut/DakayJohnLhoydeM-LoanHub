<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    // Get all loans with relationships
    public function getLoans()
    {
        $loans = Loan::with('loanType', 'requirement', 'loanStatus', 'requirementSubmit')->get();
        return response()->json(['loans' => $loans]);
    }

    // Add a new loan
    public function addLoan(Request $request)
    {
        $request->validate([
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'contact'          => ['required', 'string', 'max:20'],
            'address'          => ['required', 'string', 'max:255'],
            'loan_type_id'     => ['required', 'exists:loan_types,id'],
            'requirements_id'  => ['required', 'exists:requirements,id'],
            'requirement_submit_id' => ['required', 'exists:requirement_submits,id'],
            'amount'           => ['required', 'numeric', 'min:0'],
            'loan_status_id'   => ['required', 'exists:loan_statuses,id'],
            'date'             => ['required', 'date'],
        ]);

        $loan = Loan::create([
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'contact'          => $request->contact,
            'address'          => $request->address,
            'loan_type_id'     => $request->loan_type_id,
            'requirements_id'  => $request->requirements_id,
            'requirement_submit_id' => $request->requirement_submit_id,
            'amount'           => $request->amount,
            'loan_status_id'   => $request->loan_status_id,
            'date'             => $request->date,
        ]);

        return response()->json(['message' => 'Loan successfully created!', 'loan' => $loan]);
    }

    // Edit a loan
    public function editLoan(Request $request, $id)
    {
        $request->validate([
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'contact'          => ['required', 'string', 'max:20'],
            'address'          => ['required', 'string', 'max:255'],
            'loan_type_id'     => ['required', 'exists:loan_types,id'],
            'requirements_id'  => ['required', 'exists:requirements,id'],
            'requirement_submit_id' => ['required', 'exists:requirement_submits,id'],
            'amount'           => ['required', 'numeric', 'min:0'],
            'loan_status_id'   => ['required', 'exists:loan_statuses,id'],
            'date'             => ['required', 'date'],
        ]);

        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found!'], 404);
        }

        $loan->update([
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'contact'          => $request->contact,
            'address'          => $request->address,
            'loan_type_id'     => $request->loan_type_id,
            'requirements_id'  => $request->requirements_id,
            'requirement_submit_id' => $request->requirement_submit_id,
            'amount'           => $request->amount,
            'loan_status_id'   => $request->loan_status_id,
            'date'             => $request->date,
        ]);

        return response()->json(['message' => 'Loan successfully updated!', 'loan' => $loan]);
    }

    // Delete a loan
    public function deleteLoan($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found!'], 404);
        }

        $loan->delete();
        return response()->json(['message' => 'Loan successfully deleted!']);
    }
}
