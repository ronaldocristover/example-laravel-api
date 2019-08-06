<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserController extends Controller
{
   public function authenticate(Request $request)
   {
      $this->validate($request, [
       'email' => 'required',
       'password' => 'required'
        ]);
      
      $user = User::where('email', $request->input('email'))->first();
      if(is_null($user)){
        return $this->wrapper($status = 'NOT OK', $result = [], $responseCode = 400, [
          'message' => 'Email Not Found'
        ]);
      }

       if(Hash::check($request->input('password'), $user->password)){
            $apikey = base64_encode(str_random(40));
            User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);;
            // return response()->json(['status' => 'success','api_key' => $apikey]);
            return $this->wrapper($status = 'OK', $result = [
              'access_token' => $apikey
            ], $responseCode = 200);
        }else{
            return response()->json(['status' => 'fail'],401);
        }

   }

   public function signup(Request $request)
   {
     $this->validate($request, [
      'name' => 'required',
       'email' => 'required',
       'password' => 'required'
        ]);

     $hashedPassword = Hash::make($request->get('password'));
     $user = User::create([
      'name' => $request->get('name'), 
    'email' => $request->get('email'), 
      'password' => $hashedPassword
     ]);
     if($user){
            return $this->wrapper('OK', $user, 201);
        }
        return $this->wrapper('NOT OK', [], 400, 'Error');
   }
}
