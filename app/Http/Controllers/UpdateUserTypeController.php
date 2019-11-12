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

    public function update(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}