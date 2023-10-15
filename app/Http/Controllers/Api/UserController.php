<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function showTable()
    {
        Log::channel('slack')->error('here');
        try{
        $users = User::all();
        return response()->json($users);
        } catch (\Exception $e) {
            Log::channel('slack')->error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function addUser(Request $request)
    {
        try{
            Log::channel('slack')->error('here');
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string',
            ]);
        
            $user = new User;
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();
        
            return redirect(url('/users'))->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::channel('slack')->error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($data);
        return response()->json($user);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}    
