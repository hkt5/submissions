<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateSubmissionController extends Controller
{
     /** @var CreateChannelStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::CREATE_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

     /**
     * Create new submission.
     * [ Create new submission. ]
     *
     * @bodyParam name string required min:3 max:167  name of a user.
     * @bodyParam surname string required min:3 max:167 - surname of a user.
     * @bodyParam phone phone-number required phone number - minimum 7 characters.
     * @bodyParam email email required email mus be unique - cannot be used by anyone else.
     * @bodyParam developer_type integer required  type of a developer.
     * @bodyParam developer_skill integer required  skill of a developer.
     * @bodyParam linked_in_profile string required  linked in profile.
     * @bodyParam github_profile string required github profile.
     * @bodyParam description string required  description.
     * @bodyParam files json required  files.
     * @bodyParam submission_type integer required exists:user_types,id  id of a submission.
     
     * @response 200 
     {"content":{"submission":{"name":"Czesiu","surname":"Kowalski","phone":"0700880788","developer_type":"8","developer_skill":"7","linked_in_profile":"linked_in_profile","github_profile":"http:\/\/www.github.com\/czesiukowalski","description":"awesome developer","submission_type":"1","files":"{\"file\":\"somefile.txt\"}","email":"czesiu@gmail.com","updated_at":"2019-11-15 12:09:10","created_at":"2019-11-15 12:09:10","id":1}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"email":["The email has already been taken."]}}
     * @response 400 {"content":[],"error_messages":{"email":["The email format is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"email":["The email has already been taken."]}}
     * @response 400 {"content":[],"error_messages":{"phone":["The phone format is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"submission_type":["The selected submission type is invalid."]}}
     */

    public function create(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}