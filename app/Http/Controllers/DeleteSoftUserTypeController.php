<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteSoftUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteSoftUserTypeController extends Controller
{
    /** @var DeleteSoftUserTypeStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_SOFT_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Soft delete user type.
     * [To soft delete a user type means it won't be visible for query GET /user-type/without-trashed, however it is still visible for query GET /user-type/with-trashed/{id}. It also means it can be restored and still phisically exists in the database]
     *
     * @bodyParam id integer required An id of a user type
     * @response 200 {"content":{"user_type":{"id":4,"name":"some user type","deleted_at":"2019-11-15 13:10:33","created_at":"2019-11-15 12:41:36","updated_at":"2019-11-15 13:10:33"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */

    public function deleteSoftUserTypeById(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}
