<?php

namespace App\Factories;

use App\Strategies\CommandStrategies\UpdateUserTypeStrategy;
use App\Strategies\CommandStrategies\CreateUserTypeStrategy;
use App\Strategies\CommandStrategies\GetUserTypeWithoutTrashedStrategy;
use App\Strategies\CommandStrategies\GetUserTypeWithTrashedStrategy;
use App\Strategies\CommandStrategies\DeleteSoftUserTypeStrategy;
use App\Strategies\CommandStrategies\DeleteHardUserTypeStrategy;
use App\Strategies\CommandStrategies\RestoreUserTypeStrategy;
use App\Strategies\CommandStrategies\CreateSubmissionStrategy;
use App\Strategies\CommandStrategies\GetSubmissionStrategy;
use App\Strategies\CommandStrategies\UpdateSubmissionStrategy;
use App\Strategies\CommandStrategies\DeleteSubmissionStrategy;


class DatabaseCommandFactory
{
    public $strategy;

    public function getInstance(string $strategy) {
        switch ($strategy) {
            
            case DatabaseOperationConstants::CREATE_USER_TYPE_STRATEGY:
                $this->strategy = new CreateUserTypeStrategy();
            break;

            case DatabaseOperationConstants::UPDATE_USER_TYPE_STRATEGY:
                $this->strategy = new UpdateUserTypeStrategy();
            break;

            case DatabaseOperationConstants::GET_USER_TYPE_WITHOUT_TRASHED_STRATEGY:
                $this->strategy = new GetUserTypeWithoutTrashedStrategy();
            break;

             case DatabaseOperationConstants::GET_USER_TYPE_WITH_TRASHED_STRATEGY:
                $this->strategy = new GetUserTypeWithTrashedStrategy();
            break;

            case DatabaseOperationConstants::DELETE_SOFT_USER_TYPE_STRATEGY:
                $this->strategy = new DeleteSoftUserTypeStrategy();
            break;

            case DatabaseOperationConstants::DELETE_HARD_USER_TYPE_STRATEGY:
                $this->strategy = new DeleteHardUserTypeStrategy();
            break;

            case DatabaseOperationConstants::RESTORE_USER_TYPE_STRATEGY:
                $this->strategy = new RestoreUserTypeStrategy();
            break;

            
            
            case DatabaseOperationConstants::CREATE_SUBMISSION_STRATEGY:
                $this->strategy = new CreateSubmissionStrategy();
            break;

            case DatabaseOperationConstants::GET_SUBMISSION_STRATEGY:
                $this->strategy = new GetSubmissionStrategy();
            break;

            case DatabaseOperationConstants::UPDATE_SUBMISSION_STRATEGY:
                $this->strategy = new UpdateSubmissionStrategy();
            break;

            case DatabaseOperationConstants::DELETE_SUBMISSION_STRATEGY:
                $this->strategy = new DeleteSubmissionStrategy();
            break;
        }
    }
}