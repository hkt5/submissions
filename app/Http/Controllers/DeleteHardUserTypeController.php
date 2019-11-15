<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteHardUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteHardUserTypeController extends Controller
{
    /** @var DeleteHardUserTypeStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_HARD_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

     /**
     * Hard delete user type.
     * [ To hard delete a user type means it is impossible to restore it. A row is physically deleted from the database]
     *
     * @bodyParam id integer required An id of a user type
     
     * @response 200 {"content":{"user_type":{"id":6,"name":"some user type","deleted_at":null,"created_at":"2019-11-15 12:54:29","updated_at":"2019-11-15 12:54:29"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */

    public function deleteHardUserTypeById(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}