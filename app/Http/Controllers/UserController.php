<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $users = User::where('user_type', 'user')->get();

        return $users;
    }


    public function getUserById(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        return $users;
    }


    public function updateUserById(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        if($users)
        {
            if($request->name)
            {
                 $users->name = $request->name;
            }
            if($request->email)
            {
                $users->email = $request->email;
            }
            if($request->hasFile('image'))
            {
                $users->image = $request->image;
            }
            if($request->hasAny('password'))
            {
                $users->password = $request->password;
            }

            if($users->update())
            {
                $response = array("status"=>"success", "message" =>"updated Sucessfully", "data" => $users);
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"data not updated", "data" => $users);
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"User Not found with given Id");
                return response()->json($response);
        }
    }



    public function createUser(Request $request)
    {
        $user = new User;
        if($request->name && $request->email && $request->password)
        {
            if(!User::where('email',$request->email)->first())
            {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                if($user->save())
                {
                    $response = array("status"=>"success", "message" =>"user created successfully", "data" => $user);
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
                $response = array("status"=>"failure", "message" =>"Name, Email and Password are mandatory");
                return response()->json($response);
            }
    }

    public function deleteUserById(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if($user)
        {
            if($user->delete())
            {
                $response = array("status"=>"success", "message" =>"User deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting User");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"user doesnot exist with given id");
            return response()->json($response);
        }
    }


    public function getAdmins(Request $request)
    {
        $users = User::where('user_type', 'admin')->get();

        return $users;
    }


    public function getAdminById(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        return $users;
    }


    public function updateAdminById(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        if($users)
        {
            if($request->name)
            {
                 $users->name = $request->name;
            }
            if($request->email)
            {
                $users->email = $request->email;
            }
            if($request->hasFile('image'))
            {
                $users->image = $request->image;
            }
            if($request->hasAny('password'))
            {
                $users->password = $request->password;
            }
            $users->user_type = "admin";
            if($users->update())
            {
                $response = array("status"=>"success", "message" =>"updated Sucessfully", "data" => $users);
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"data not updated", "data" => $users);
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"User Not found with given Id");
                return response()->json($response);
        }
    }



    public function createAdmin(Request $request)
    {
        $user = new User;
        if($request->name && $request->email && $request->password)
        {
            if(!User::where('email',$request->email)->first())
            {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type = "admin";
                $user->password = Hash::make($request->password);

                if($user->save())
                {
                    $response = array("status"=>"success", "message" =>"user created successfully", "data" => $user);
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
                $response = array("status"=>"failure", "message" =>"Name, Email and Password are mandatory");
                return response()->json($response);
            }
    }

    public function deleteAdminById(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if($user)
        {
            if($user->delete())
            {
                $response = array("status"=>"success", "message" =>"User deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting User");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"user doesnot exist with given id");
            return response()->json($response);
        }
    }


}
