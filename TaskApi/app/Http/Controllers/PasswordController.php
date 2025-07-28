<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    //

    public function sendCode(Request $request){

     $validator = Validator::make($request->all(), [
        'email' => ['required', 'email']
     ]);


     if($validator->fails()){
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->all()
        ]);
    }

        $user = User::where('email', $request->email)->first();

        if(!$user){
              return response()->json([
            'success' => false,
            'message' => 'email not found'
        ], 404 );

        }

        $code = rand(100000, 999999);

          // Store code in DB or cache (simple example)
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $code, 'created_at' => now()]
        );


         // Send email
        Mail::raw("Your password reset code is: $code", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Reset Code');
        });

        return response()->json([
           'success' => true,
            'message' => 'Code sent'
        ]);
   
     
    }

    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email'],
            'code' => ['required'],
            'password' => ['required', 'confirmed' ,'min:6']
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        if (!$reset) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid code'
            ]);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally delete the token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successful'
        ]);
    }
}
