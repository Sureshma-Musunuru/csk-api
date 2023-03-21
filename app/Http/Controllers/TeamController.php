<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function getTeams(Request $request)
    {
        $teams = TeamMember::get();

        return $teams;
    }


    public function getTeamById(Request $request)
    {
        $teams = TeamMember::where('id', $request->id)->first();
        return $teams;
    }


    public function updateTeamById(Request $request)
    {
        $teams = TeamMember::where('id', $request->id)->first();
        if($teams)
        {
            if($request->name)
            {
                 $teams->name = $request->name;
            }
            if($request->email)
            {
                $teams->email = $request->email;
            }
            if($request->description)
            {
                $teams->description = $request->description;
            }
            if($request->designation)
            {
                $teams->designation = $request->designation;
            }
           

            if($teams->update())
            {
                $response = array("status"=>"success", "message" =>"updated Sucessfully", "data" => $teams);
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"data not updated", "data" => $teams);
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"Team Not found with given Id");
                return response()->json($response);
        }
    }



    public function createTeam(Request $request)
    {
        $team = new TeamMember;
        if($request->name && $request->email && $request->designation)
        {
            if(!TeamMember::where('email',$request->email)->first())
            {
                $team->name = $request->name;
                $team->email = $request->email;
                $team->designation = $request->designation;
                $team->description = $request->description;
               

                if($team->save())
                {
                    $response = array("status"=>"success", "message" =>"team created successfully", "data" => $team);
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
                $response = array("status"=>"failure", "message" =>"Team already exists with given email");
                return response()->json($response);
            }
        }
        else
            {
                $response = array("status"=>"failure", "message" =>"Name, Email and Password are mandatory");
                return response()->json($response);
            }
    }

    public function deleteTeamById(Request $request)
    {
        $team = TeamMember::where('id', $request->id)->first();
        if($team)
        {
            if($team->delete())
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
