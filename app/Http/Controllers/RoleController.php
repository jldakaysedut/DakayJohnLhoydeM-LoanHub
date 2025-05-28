<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function getRoles()
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles]);
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
        ]);

        $role = Role::create(['name' => $request->name]);

        return response()->json(['message' => 'Role successfully created!', 'role' => $role]);
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found!'], 404);
        }

        $role->delete();
        return response()->json(['message' => 'Role successfully deleted!']);
    }

    public function editRole(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found!'], 404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $id],
        ]);

        $role->update($request->all());
        return response()->json(['message' => 'Role updated successfully!', 'role' => $role]);
    }
}