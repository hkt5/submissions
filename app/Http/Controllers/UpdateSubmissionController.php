<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\UpdateSubmissionStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateSubmissionController extends Controller
{
    /** @var UpdateSubmissionStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::UPDATE_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Update submission.
     * [Update submission by given id. Include key value pairs you want to update]
     *
     * @bodyParam id integer required id of a submission you want to update.
     * @bodyParam name string name of a user, must contain between 3 - 167 characters.
     * @bodyParam surname string surname of a user, must contain between 3 - 167 characters.
     * @bodyParam phone phone-number phone number - minimum 7 characters.
     * @bodyParam email email must be unique - cannot be used by anyone else.
     * @bodyParam developer_type integer type of a developer.
     * @bodyParam developer_skill integer skill of a developer.
     * @bodyParam linked_in_profile string linked in profile.
     * @bodyParam github_profile string github profile.
     * @bodyParam description string description.
     * @bodyParam files json files.
     * @bodyParam submission_type integer an existing key of a user type 
     *
     * @response 200 {"content":{"submission":{"id":2,"name":"testing update","surname":"Kowalski","phone":"0700880788","email":"another@email.com","developer_type":8,"developer_skill":7,"linked_in_profile":"linked_in_profile","github_profile":"http:\/\/www.github.com\/czesiukowalski","description":"awesome developer","files":"{\"file\": \"somefile.txt\"}","submission_type":1,"created_at":"2019-11-15 12:13:33","updated_at":"2019-11-15 14:41:06"}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"email":["The email has already been taken."]}}
     * @response 400 {"content":[],"error_messages":{"email":["The email format is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"phone":["The phone format is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"submission_type":["The selected submission type is invalid."]}}
     */

    public function updateSubmission(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}
