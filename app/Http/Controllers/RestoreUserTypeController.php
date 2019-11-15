<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\RestoreUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestoreUserTypeController extends Controller
{
    /** @var RestoreUserTypeStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::RESTORE_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

     /**
     * Restore trashed user type.
     * [Restore user type that has been soft deleted.]
     *
     * @bodyParam id integer required Id of a soft deleted user type
     
     * @response 200 
     {"content":{"user_type":{"id":4,"name":"some user type","deleted_at":null,"created_at":"2019-11-15 12:41:36","updated_at":"2019-11-15 14:17:53"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"error":"The user is not soft deleted"}}
     */

    public function restoreUserType(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}