<?php

namespace App\Strategies\CommandStrategies;

use App\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CreateUserTypeStrategy 
{
    private $rules = [
      'name' => 'required|string|unique:user_types|min:3|max:167'
    ];

    public function command(Request $request): JsonResponse
    {
          try 
          {
              return $this->tryToCreateUserType($request);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToCreateUserType(Request $request) : JsonResponse
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
            $userType = $this->createUserType($request);
            return response()->json(
                ['content' => ['user_type' => $userType], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
    private function createUserType(Request $request): UserType
    {
        $userType = new UserType();
        $userType->name = $request->get('name');
        $userType->save();
        return $userType; 
    }
}