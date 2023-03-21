<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if($request->name && $request->email && $request->password )
        {
            if(!User::where("email", $request->email)->first())
            {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                if($user->save())
                {
                    $token = $user->createToken("user_token")->plainTextToken;
 
                    $response = array("status"=>"success", "message" =>"user created successfully", "data" => $user,'token' => $token);
                    return response()->json($response);
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"There is some issue with user creation");
                    return response()->json($response);
                }
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"User already exists with given email");
                return response()->json($response);
            }
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"User Name, Email and Password are manadatory");
            return response()->json($response);
        }

    }

    public function adminregister(Request $request)
    {
        if($request->name && $request->email && $request->password )
        {
            if(!User::where("email", $request->email)->first())
            {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type = "admin";
                $user->password = Hash::make($request->password);

                if($user->save())
                {
                    $token = $user->createToken("user_token")->plainTextToken;
 
                    $response = array("status"=>"success", "message" =>"user created successfully", "data" => $user,'token' => $token);
                    return response()->json($response);
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"There is some issue with user creation");
                    return response()->json($response);
                }
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"User already exists with given email");
                return response()->json($response);
            }
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"User Name, Email and Password are manadatory");
            return response()->json($response);
        }

    }



    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        if(!$user)
        {
            $response = array("status"=>"failure", "message" =>"User does not exist with given email");
            return response()->json($response);
        }
        if(Hash::check($request->password, $user->password))
        {
            $token = $user->createToken("user_token")->plainTextToken;
 
            $response = array("status"=>"success", "message" =>"user logged in successfully", "data" => $user,'token' => $token);
            return response()->json($response);
        }
        else
        { 
            $response = array("status"=>"failure", "message" =>"Invalid Credentials");
            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        // $user->tokens()->delete();
        $response = array("status"=>"success", "message" =>"user loggedout successully");
        return response()->json($response);
    }


    public function gotologin()
    {
        $response = array("status"=>"failure", "message" =>"Please login");
        return response()->json($response);
    }
}
