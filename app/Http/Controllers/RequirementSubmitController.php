<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequirementSubmit;

class RequirementSubmitController extends Controller
{
    public function getRequirementSubmits()
    {
        $requirementSubmits = RequirementSubmit::all();
        return response()->json(['requirementSubmits' => $requirementSubmits]);
    }

    public function addRequirementSubmit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:requirement_submits'],
        ]);

        $requirementSubmit = RequirementSubmit::create(['name' => $request->name]);

        return response()->json(['message' => 'Requirement submit successfully created!', 'requirementSubmit' => $requirementSubmit]);
    }

    public function deleteRequirementSubmit($id)
    {
        $requirementSubmit = RequirementSubmit::find($id);
        if (!$requirementSubmit) {
            return response()->json(['message' => 'Requirement submit not found!'], 404);
        }

        $requirementSubmit->delete();
        return response()->json(['message' => 'Requirement submit successfully deleted!']);
    }

    public function editRequirementSubmit(Request $request, $id)
    {
        $requirementSubmit = RequirementSubmit::find($id);
        if (!$requirementSubmit) {
            return response()->json(['message' => 'Requirement submit not found!'], 404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:requirement_submits,name,' . $id],
        ]);

        $requirementSubmit->update($request->all());
        return response()->json(['message' => 'Requirement submit updated successfully!', 'requirementSubmit' => $requirementSubmit]);
    }
}