<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStatus;

class UserStatusController extends Controller
{
    public function getUserStatuses()
    {
        $statuses = UserStatus::all();
        return response()->json(['statuses' => $statuses]);
    }

    public function addUserStatus(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:user_statuses'],
        ]);

        $status = UserStatus::create(['name' => $request->name]);

        return response()->json(['message' => 'User status successfully created!', 'status' => $status]);
    }

    public function deleteUserStatus($id)
    {
        $status = UserStatus::find($id);
        if (!$status) {
            return response()->json(['message' => 'User status not found!'], 404);
        }

        $status->delete();
        return response()->json(['message' => 'User status successfully deleted!']);
    }

    public function editUserStatus(Request $request, $id)
    {
        $status = UserStatus::find($id);
        if (!$status) {
            return response()->json(['message' => 'User status not found!'], 404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:user_statuses,name,' . $id],
        ]);

        $status->update($request->all());
        return response()->json(['message' => 'User status updated successfully!', 'status' => $status]);
    }
}