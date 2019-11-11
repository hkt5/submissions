<?php

namespace App\Strategies\CommandStrategies;

use App\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class GetUserTypeWithoutTrashedStrategy 
{
    private $rules = [
      'id' => 'required|int|exists:user_types'
    ];

    public function findById($id): JsonResponse
    {
          try 
          {
              return $this->tryToGetUserType($id);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToGetUserType($id) : JsonResponse
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
            $userType = UserType::find($id);

            if($userType === null)
            {
              throw new \Exception("The user was not found");
            }

            return response()->json(
                ['content' => ['user_type' => $userType], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
}