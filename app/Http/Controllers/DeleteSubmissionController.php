<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteSubmissionStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteSubmissionController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function deleteSubmissionById(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}