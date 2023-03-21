<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function getBanners(Request $request)
    {
        $banners = Banner::all();

        return $banners;
    }


    public function getBannerById(Request $request)
    {
        $banners = Banner::where('id', $request->id)->first();
        return $banners;
    }


    public function createBanner(Request $request)
    {

        $banner = new Banner;
        if($request->hasFile('image') && $request->title)
        {
                $destinationPath = "public/banners";
                $file_name = rand(1000,25000)."-".$request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs($destinationPath, $file_name);
 
            
                $banner->title = $request->title;
                $banner->image = "storage/banners/".$file_name;

                if($banner->save())
                {
                    $response = array("status"=>"success", "message" =>"Banner created successfully", "data" => $banner);
                    return response()->json($response);
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"There is some issue with Banner creation");
                    return response()->json($response);
                }
            
        }
        else
            {
                $response = array("status"=>"failure", "message" =>"Name, Email and Password are mandatory");
                return response()->json($response);
            }
    }

    public function deleteBannerById(Request $request)
    {
        $banner = Banner::where('id', $request->id)->first();
        if($banner)
        {
            if($banner->delete())
            {
                $response = array("status"=>"success", "message" =>"Banner deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting Banner");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"Banner doesnot exist with given id");
            return response()->json($response);
        }
    }

    public function updateBannerById(Request $request)
    {
        $banner = Banner::where('id', $request->id)->first();
        if($banner)
        {
                if($request->hasFile("image"))
                {
                    $destinationPath = "public/banners";
                    $file_name = rand(1000,25000)."-".$request->file('image')->getClientOriginalName();
                    $path = $request->file('image')->storeAs($destinationPath, $file_name);
    
                
                    $banner->title = $request->title;
                    $banner->image = "storage/banners/".$file_name;
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"Please upload Image");
                    return response()->json($response);
                }

            if($banner->update())
            {
                $response = array("status"=>"success", "message" =>"Banner deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting Banner");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure","title"=>$request,"id"=>$request->id, "message" =>"Banner does not exist with given id --441");
            return response()->json($response);
        }
    }
}
