<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\UpdateSubmissionStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateSubmissionController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::UPDATE_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function updateSubmission(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}