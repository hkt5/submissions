<?php

namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\RestoreUserTypeStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestoreUserTypeController extends Controller
{
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::RESTORE_USER_TYPE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function restoreUserType(Request $request) : JsonResponse
    {
        return $this->strategy->command($request);
    }
}