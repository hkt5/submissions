<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteSubmissionStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteSubmissionController extends Controller
{
    /** @var DeleteSubmissionStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Delete submission.
     * [Deletes submission with given id]
     *
     * @bodyParam id integer required An id of a submission
     
     * @response 200 {"content":{"submission":{"id":1,"name":"Czesiu","surname":"Kowalski","phone":"0700880788","email":"czesiu@gmail.com","developer_type":8,"developer_skill":7,"linked_in_profile":"linked_in_profile","github_profile":"http:\/\/www.github.com\/czesiukowalski","description":"awesome developer","files":"{\"file\": \"somefile.txt\"}","submission_type":1,"created_at":"2019-11-15 12:09:10","updated_at":"2019-11-15 12:09:10"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */

    public function deleteSubmissionById(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}