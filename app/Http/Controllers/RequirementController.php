<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;

class RequirementController extends Controller
{
    public function getRequirements()
    {
        $requirements = Requirement::all();
        return response()->json(['requirements' => $requirements]);
    }

    public function addRequirement(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:requirements'],
        ]);

        $requirement = Requirement::create(['name' => $request->name]);

        return response()->json(['message' => 'Requirement successfully created!', 'requirement' => $requirement]);
    }

    public function deleteRequirement($id)
    {
        $requirement = Requirement::find($id);
        if (!$requirement) {
            return response()->json(['message' => 'Requirement not found!'], 404);
        }

        $requirement->delete();
        return response()->json(['message' => 'Requirement successfully deleted!']);
    }

    public function editRequirement(Request $request, $id)
    {
        $requirement = Requirement::find($id);
        if (!$requirement) {
            return response()->json(['message' => 'Requirement not found!'], 404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:requirements,name,' . $id],
        ]);

        $requirement->update($request->all());
        return response()->json(['message' => 'Requirement updated successfully!', 'requirement' => $requirement]);
    }
}