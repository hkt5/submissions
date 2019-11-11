<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteSoftUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteSoftUserTypeController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_SOFT_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function deleteSoftUserTypeById(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}