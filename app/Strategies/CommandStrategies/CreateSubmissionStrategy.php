<?php

namespace App\Strategies\CommandStrategies;

use App\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CreateSubmissionStrategy 
{
    private $rules = [
      'name' => 'required|string|min:3|max:167',
      'surname' => 'required|string|min:3|max:167',
      'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
      'email' => 'required|email|unique:submissions',
      'developer_type' => 'required|integer',
      'developer_skill' => 'required|integer',
      'linked_in_profile' => 'required|url',
      'github_profile' => 'required|url',
      'description' => 'required|string',
      'files' => 'required|json',
      'submission_type' => 'required|int|exists:user_types,id',
    ];

    public function command(Request $request): JsonResponse
    {
          try 
          {
              return $this->tryToCreateSubmission($request);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToCreateSubmission(Request $request) : JsonResponse
    {
       
       $validator = Validator::make($request->all(), $this->rules);

       if($validator->fails())
       {
            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } 
        else 
        {
            $submission = $this->createSubmission($request);
            return response()->json(
                ['content' => ['submission' => $submission], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
    private function createSubmission(Request $request): Submission
    {
        $submission = Submission::create($request->all());
        return $submission; 
    }
}