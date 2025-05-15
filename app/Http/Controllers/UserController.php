<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
     // Get all users with role and status
     public function getUsers()
     {
         $users = User::with('role', 'userStatus')->get();
         return response()->json(['users' => $users]);
     }
 
     // Add a new user
     public function addUser(Request $request)
     {
         $request->validate([
             'first_name' => ['required', 'string', 'max:255'],        
             'last_name' => ['required', 'string', 'max:255'],
             'contact' => ['required', 'string', 'max:20'],
             'username' => ['required', 'string', 'max:255', 'unique:users'],
             'email' => ['required', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:8'],
             'role_id' => ['required', 'exists:roles,id'],
             'user_status_id' => ['required', 'exists:user_statuses,id'],
         ]);
 
         $user = User::create([
             'first_name' => $request->first_name,         
             'last_name' => $request->last_name,
             'contact' => $request->contact,
             'username' => $request->username,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'role_id' => $request->role_id,
             'user_status_id' => $request->user_status_id,
         ]);
 
         return response()->json(['message' => 'User successfully created!', 'user' => $user]);
     }
 
     // Edit an existing user
     public function editUser(Request $request, $id)
     {
         $request->validate([
             'first_name' => ['required', 'string', 'max:255'],       
             'last_name' => ['required', 'string', 'max:255'],
             'contact' => ['required', 'string', 'max:20'],
             'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
             'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
             'role_id' => ['required', 'exists:roles,id'],
             'user_status_id' => ['required', 'exists:user_statuses,id'],
         ]);
 
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'User not found!'], 404);
         }
 
         $user->update([
             'first_name' => $request->first_name,          
             'last_name' => $request->last_name,
             'contact' => $request->contact,
             'username' => $request->username,
             'email' => $request->email,
             'role_id' => $request->role_id,
             'user_status_id' => $request->user_status_id,
         ]);
 
         return response()->json(['message' => 'User successfully updated!', 'user' => $user]);
     }
 
     // Delete a user
     public function deleteUser($id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'User not found!'], 404);
         }
 
         $user->delete();
         return response()->json(['message' => 'User successfully deleted!']);
     }
}
