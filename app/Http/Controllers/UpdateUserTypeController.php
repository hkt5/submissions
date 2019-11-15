<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\UpdateUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateUserTypeController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::UPDATE_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

       /**
     * Update user type.
     * [Update user type by given id]
     *
     * @bodyParam id integer required Id of a user type you want to update.
     * @bodyParam name string required User type name you want to update. Must contain 3-167 characters.
     
     * @response 200 
     {"content":{"user_type":{"id":7,"name":"testing","deleted_at":null,"created_at":"2019-11-15 13:55:45","updated_at":"2019-11-15 14:59:29"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name must be at least 3 characters."]}}
     */

    public function update(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}