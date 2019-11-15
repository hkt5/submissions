<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\GetSubmissionStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetSubmissionByIdController extends Controller
{
    /** @var GetUserTypeStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::GET_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Get submission.
     * [Returns submission by given id]
     *
     * @queryParam id required id of a submission

     * @response 200 {"content":{"submission":{"id":2,"name":"name awesome","surname":"Kowalski","phone":"0700880788","email":"another@email.com","developer_type":8,"developer_skill":7,"linked_in_profile":"linked_in_profile","github_profile":"http:\/\/www.github.com\/czesiukowalski","description":"awesome developer","files":"{\"file\": \"somefile.txt\"}","submission_type":1,"created_at":"2019-11-15 12:13:33","updated_at":"2019-11-15 12:13:33"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */

    public function getSubmissionById($id) : JsonResponse
    {
        return $this->strategy->command($id);
    }
}