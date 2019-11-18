<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateUserTypeController extends Controller
{
    /** @var CreateUserTypeStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::CREATE_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Create new user type.
     * [ Create new user type. ]
     * @bodyParam name string required  Name of a user type. Must contain between 3 - 167 characters and must be unique. Two or more exacly the same names are not allowed.
     * @response 200 {"content":{"user_type":{"name":"some name","updated_at":"2019-11-15 12:39:00","created_at":"2019-11-15 12:39:00","id":3}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name has already been taken."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name must be at least 3 characters."]}}
     */

    public function create(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}

