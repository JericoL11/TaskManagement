<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request
     * @return User
     */

    public function createUser(Request $request)
    {
         // Validate first
        $validators = Validator::make($request->all(), [
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'min:8'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'middleName' => ['nullable', 'string'],
            'birthDate' => ['required', 'date'],
            'address' => ['required', 'string'],
            'contactNo' => ['required', 'string']
        ]);

        if ($validators->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validators->errors()
            ], 422);
        }

        try {
            DB::beginTransaction(); // ✅ Start transaction

            $person = Person::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'middleName' => $request->middleName ?? null,
            'birthDate' => $request->birthDate,
            'address' => $request->address,
            'contactNo' => $request->contactNo
        ]);


        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'person_id' => $person->person_id
        ]);
            
            DB::commit(); // ✅ Save both if all is good

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API Token")->plainTextToken
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack(); // ❌ Undo everything on failure

            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function loginUser(Request $request){
        $validators = Validator::make($request->all(),[
            'username' => ['required'],
            'password' => ['required', 'min:6']
        ]);

        if($validators->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validators->errors()
            ],422);
        }

        $user = User::where('username', $request->username)->first();  //check the username first

        // return response()->json(Hash::check($request->password, $user->password));

        
        // 🔐 Fail if user not found or password is incorrect
        if(!$user || !Hash::check($request->password, $user->password)){
       
            return 'Invalid credentials.';
        }

        $token = $user->createToken('api-token')->plainTextToken; 

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);

    }

      // 🔴 Logout (optional)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    // 🔒 Get Authenticated User
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

}

