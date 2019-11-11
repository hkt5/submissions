<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\GetUserTypeWithTrashedStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserTypeWithTrashedController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::GET_USER_TYPE_WITH_TRASHED_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function findByIdWithTrashed($id) : JsonResponse
    {
        return $this->strategy->findById($id);
    }
}