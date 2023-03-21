<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function getPages(Request $request)
    {
        $pages = Page::get();

        return $pages;
    }


    public function getPageById(Request $request)
    {
        $pages = Page::where('id', $request->id)->first();
        return $pages;
    }


    public function getPageBySlug(Request $request)
    {
        $pages = Page::where('slug', $request->slug)->first();
        return $pages;
    }



    public function updatePageById(Request $request)
    {
        $pages = Page::where('id', $request->id)->first();
        if($pages)
        {
            if($request->title)
            {
                 $pages->title = $request->title;
            }
            if($request->slug)
            {
                $pages->slug = $request->slug;
            }
            if($request->content)
            {
                $pages->content = $request->content;
            }
            
           

            if($pages->update())
            {
                $response = array("status"=>"success", "message" =>"updated Sucessfully", "data" => $pages);
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"data not updated", "data" => $pages);
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"Page Not found with given Id");
                return response()->json($response);
        }
    }



    public function createPage(Request $request)
    {
        $page = new Page;
        if($request->title && $request->content && $request->slug)
        {
            if(!Page::where('slug',$request->slug)->first())
            {
                $page->title = $request->title;
                $page->content = $request->content;
                $page->slug = $request->slug;
               

                if($page->save())
                {
                    $response = array("status"=>"success", "message" =>"Page created successfully", "data" => $page);
                    return response()->json($response);
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"There is some issue with page creation");
                    return response()->json($response);
                }
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"Page already exists with given slug");
                return response()->json($response);
            }
        }
        else
            {
                $response = array("status"=>"failure", "message" =>"Title, Content and Slug are mandatory");
                return response()->json($response);
            }
    }

    public function deletePageById(Request $request)
    {
        $page = Page::where('id', $request->id)->first();
        if($page)
        {
            if($page->delete())
            {
                $response = array("status"=>"success", "message" =>"Page deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting Page");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"Page doesnot exist with given id");
            return response()->json($response);
        }
    }


}
