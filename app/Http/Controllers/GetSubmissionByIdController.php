<?php 
namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\GetUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetSubmissionByIdController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::GET_SUBMISSION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function getSubmissionById($id) : JsonResponse
    {
        return $this->strategy->command($id);
    }
}