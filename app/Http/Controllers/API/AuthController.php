<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;



class AuthController extends Controller
{
    protected $warningCode = 500;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if ($validator->fails()) {
			return response()->json(['message' => $validator->errors()->first(), 'error' => $validator->errors()], $this->warningCode);
		}

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        return response()->json(['message' => 'User created successfully'], 201);
    }

    // Login user and issue access token
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            return response()->json([
            'token' => $user->createToken('API Token')->accessToken,
        ], 201);  

        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function update(Request $request, $id)
    {
        dd('dsf');
        $user = User::where('id',$id)->first();
        if($user){
            $user->update($request->all());

            return response()->json(['message' => 'User updated successfully', 'user' => $user]);       

        }else{
            return response()->json(['message' => 'No User found', 404]);       

        }

       
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
