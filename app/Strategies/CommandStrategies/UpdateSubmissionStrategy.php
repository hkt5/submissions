<?php

namespace App\Strategies\CommandStrategies;

use App\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UpdateSubmissionStrategy 
{
    private $rules = [
      'id' => 'required|integer|exists:submissions,id',
      'name' => 'sometimes|string|min:3|max:167',
      'surname' => 'sometimes|string|min:3|max:167',
      'phone' => 'sometimes|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
      'email' => 'sometimes|email|unique:submissions',
      'developer_type' => 'sometimes|integer',
      'developer_skill' => 'sometimes|integer',
      'linked_in_profile' => 'sometimes|url',
      'github_profile' => 'sometimes|url',
      'description' => 'sometimes|string',
      'files' => 'sometimes|json',
      'submission_type' => 'sometimes|int|exists:user_types,id',
    ];

    public function command(Request $request): JsonResponse
    {
          try 
          {
              return $this->tryToUpdateSubmission($request);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToUpdateSubmission(Request $request) : JsonResponse
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
            $submission = $this->updateSubmission($request);
            return response()->json(
                ['content' => ['submission' => $submission], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
    private function updateSubmission(Request $request): Submission
    {
        $submission = Submission::find($request->get('id'));
        $submission->update($request->all());
        $submission->save();
        return $submission; 
    }
}