<?php

namespace App\Strategies\CommandStrategies;

use App\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UpdateUserTypeStrategy 
{
    private $rules = [
      'id' => 'required|int|exists:user_types',
      'name' => 'required|string|unique:user_types|min:3|max:167'
    ];

    public function command(Request $request): JsonResponse
    {
          try 
          {
              return $this->tryToUpdateUserType($request);    
          } 
          catch (\Exception $e) 
          {
             Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);    
          }  
    }

    private function tryToUpdateUserType(Request $request) : JsonResponse
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
            $userType = $this->updateUserType($request);
            return response()->json(
                ['content' => ['user_type' => $userType], 'error_messages' => []], Response::HTTP_OK
            );
        } 
    }
   
    private function updateUserType(Request $request): UserType
    {
        $userType = UserType::withTrashed()->where('id',$request->get('id'))->get()->first();

        $userType->__set('name', $request->get('name'));
        $userType->save();
        return $userType; 
    }
}