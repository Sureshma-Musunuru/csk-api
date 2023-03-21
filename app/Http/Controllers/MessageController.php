<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function getMessages(Request $request)
    {
        $messages = Message::get();

        return $messages;
    }


    public function getMessageById(Request $request)
    {
        $messages = Message::where('id', $request->id)->first();
        return $messages;
    }






    public function createMessage(Request $request)
    {
        $message = new Message;
        if($request->name && $request->email && $request->message)
        {
            
                $message->name = $request->name;
                $message->email = $request->email;
                $message->message = $request->message;
               

                if($message->save())
                {
                    $response = array("status"=>"success", "message" =>"team created successfully", "data" => $message);
                    return response()->json($response);
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"There is some issue with team creation");
                    return response()->json($response);
                }
        }
        else
            {
                $response = array("status"=>"failure", "message" =>"Name, Email and Password are mandatory");
                return response()->json($response);
            }
    }

    public function deleteMessageById(Request $request)
    {
        $message = Message::where('id', $request->id)->first();
        if($message)
        {
            if($message->delete())
            {
                $response = array("status"=>"success", "message" =>"Team member deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting Team");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"team doesnot exist with given id");
            return response()->json($response);
        }
    }


}
