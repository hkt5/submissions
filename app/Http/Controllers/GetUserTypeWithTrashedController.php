<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\GetUserTypeWithTrashedStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserTypeWithTrashedController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::GET_USER_TYPE_WITH_TRASHED_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Get user types including trashed ones.
     * [Returns user type data by given id, returns also soft deleted user types.]
     *
     * @queryParam id required id of a user type

     * @response 200{"content":{"user_type":{"id":7,"name":"test user type","deleted_at":null,"created_at":"2019-11-15 13:55:45","updated_at":"2019-11-15 13:55:45"}},"error_messages":[]}
     * @response 200{"content":{"user_type":{"id":4,"name":"some user type","deleted_at":"2019-11-15 13:10:33","created_at":"2019-11-15 12:41:36","updated_at":"2019-11-15 13:10:33"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */

    public function findByIdWithTrashed($id) : JsonResponse
    {
        return $this->strategy->findById($id);
    }
}
