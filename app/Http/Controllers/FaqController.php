<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Question;

class FaqController extends Controller
{
    public function getFaqs(Request $request)
    {
        $faq = Question::all();

        return $faq;
    }


    public function getFaqById(Request $request)
    {
        $faq = Question::where('id', $request->id)->first();
        return $faq;
    }


    public function updateFaqById(Request $request)
    {
        $faqs = Question::where('id', $request->id)->first();
        if($faqs)
        {
            if($request->question)
            {
                 $faqs->question = $request->question;
            }
            if($request->answer)
            {
                $faqs->answer = $request->answer;
            }
            
            
           

            if($faqs->update())
            {
                $response = array("status"=>"success", "message" =>"updated Sucessfully", "data" => $faqs);
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"data not updated", "data" => $faqs);
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"Faq Not found with given Id");
                return response()->json($response);
        }
    }



    public function createFaq(Request $request)
    {
        $faq = new Question;
        if($request->question && $request->answer)
        {
        
                $faq->question = $request->question;
                $faq->answer = $request->answer;
              

                if($faq->save())
                {
                    $response = array("status"=>"success", "message" =>"Faq created successfully", "data" => $faq);
                    return response()->json($response);
                }
                else
                {
                    $response = array("status"=>"failure", "message" =>"There is some issue with faq creation");
                    return response()->json($response);
                }
        }
        else
            {
                $response = array("status"=>"failure", "message" =>"Title, Content and Slug are mandatory");
                return response()->json($response);
            }
    }

    public function deleteFaqById(Request $request)
    {
        $faq = Question::where('id', $request->id)->first();
        if($faq)
        {
            if($faq->delete())
            {
                $response = array("status"=>"success", "message" =>"Faq deleted successfully");
                return response()->json($response);
            }
            else
            {
                $response = array("status"=>"failure", "message" =>"There is some error while deleting Faq");
                return response()->json($response);
            }
            
        }
        else
        {
            $response = array("status"=>"failure", "message" =>"Faq doesnot exist with given id");
            return response()->json($response);
        }
    }


}
