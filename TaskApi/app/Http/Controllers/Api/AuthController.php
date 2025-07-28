<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'password' => ['required', 'min:8', 'confirmed'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'middleName' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'birthDate' => ['required', 'date'],
            'address' => ['required', 'string'],
            'contactNo' => ['required', 'string']   
        ]);

        if ($validators->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validators->errors()->all()
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

          User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'person_id' => $person->person_id
        ]);
            
            DB::commit(); // ✅ Save both if all is good

            return response()->json([
                'success' => true,
                'message' => 'User created successfully'
              //  'token' => $user->createToken("API Token")->plainTextToken
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
                'errors' => $validators->errors()->all()
            ],422);
        }

        $user = User::where('username', $request->username)->first();  //check the username first

        // return response()->json(Hash::check($request->password, $user->password));

        
        // 🔐 Fail if user not found or password is incorrect
        if(!$user || !Hash::check($request->password, $user->password)){
       
            return  response()->json([
                'errors' => 'Invalid credentials.'
            ], 401);
        }

           // $token = $user->createToken('api-token', ['*'], now()->addMinutes(1))->plainTextToken; --add expire token

            $token = $user->createToken($user->username.'api-token')->plainTextToken; 

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);

    }

      // 🔴 Logout (optional)
    public function logout(Request $request)
    {

        $user = User::where('user_id', $request->user()->user_id)->first();

        if($user){

            // $request->user()->currentAccessToken()->delete();
            $user->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully',
            ]);
        }   
        else{
            return response()->json(['success' => false, 'message' => 'User is not available']);
        }
     
    }

    // 🔒 Get Authenticated User
    public function profile(Request $request)
    {
        if($request->user()){

             return response()->json($request->user());
        }
    
        // when error it will be handled by APP/EXCEPTIONS/HANDLER.PHP  -> unauthenticated() function
    
    }

}

