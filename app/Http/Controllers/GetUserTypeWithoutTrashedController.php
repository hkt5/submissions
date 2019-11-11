<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\GetUserTypeWithoutTrashedStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUserTypeWithoutTrashedController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::GET_USER_TYPE_WITHOUT_TRASHED_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function findByIdWithoutTrashed($id) : JsonResponse
    {
        return $this->strategy->findById($id);
    }
}