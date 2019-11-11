<?php

namespace App\Strategies\CommandStrategies;

use App\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class DeleteSubmissionStrategy 
{
    private $rules = [
      'id' => 'required|integer|exists:submissions,id'
    ];

    public function command(Request $request): JsonResponse
    {
          try 
          {
              return $this->tryToDeleteSubmission($request);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToDeleteSubmission(Request $request) : JsonResponse
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
            $submission = $this->deleteSubmission($request);
            return response()->json(
                ['content' => ['submission' => $submission], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
    private function deleteSubmission(Request $request): Submission
    {
        $submission = Submission::find($request->get('id'));
        $submission->delete();
        return $submission; 
    }
}