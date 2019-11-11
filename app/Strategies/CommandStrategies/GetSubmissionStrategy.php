<?php

namespace App\Strategies\CommandStrategies;

use App\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class GetSubmissionStrategy 
{
    private $rules = [
      'id' => 'required|integer|exists:submissions'
    ];

    public function command($id): JsonResponse
    {
          try 
          {
              return $this->tryToGetSubmission($id);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToGetSubmission($id) : JsonResponse
    {
       
       $validator = Validator::make(['id' => $id], $this->rules);

       if($validator->fails())
       {
            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } 
        else 
        {
            $submission = $this->getSubmission($id);
            return response()->json(
                ['content' => ['submission' => $submission], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
    private function getSubmission($id): Submission
    {
        $submission = Submission::find($id);
       
        return $submission; 
    }
}