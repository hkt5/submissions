<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\GetUserTypeWithoutTrashedStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserTypeWithoutTrashedController extends Controller
{
    /** @var GetUserTypeWithoutTrashedStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::GET_USER_TYPE_WITHOUT_TRASHED_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Get only untrashed user types.
     * [Returns user type data by given id but returns only users that are not soft deleted.]
     *
     * @queryParam id required id of a user type
     * @response 200 {"content":{"user_type":{"id":7,"name":"test user type","deleted_at":null,"created_at":"2019-11-15 13:55:45","updated_at":"2019-11-15 13:55:45"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"error":"The selected id is invalid."}}
     */

    public function findByIdWithoutTrashed($id) : JsonResponse
    {
        return $this->strategy->findById($id);
    }
}
