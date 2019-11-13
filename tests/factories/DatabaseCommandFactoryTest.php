<?php

use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateSubmissionStrategy;
use App\Strategies\CommandStrategies\CreateUserTypeStrategy;
use App\Strategies\CommandStrategies\DeleteHardUserTypeStrategy;
use App\Strategies\CommandStrategies\DeleteSoftUserTypeStrategy;
use App\Strategies\CommandStrategies\DeleteSubmissionStrategy;
use App\Strategies\CommandStrategies\GetSubmissionStrategy;
use App\Strategies\CommandStrategies\GetUserTypeWithoutTrashedStrategy;
use App\Strategies\CommandStrategies\GetUserTypeWithTrashedStrategy;
use App\Strategies\CommandStrategies\RestoreUserTypeStrategy;
use App\Strategies\CommandStrategies\UpdateSubmissionStrategy;
use App\Strategies\CommandStrategies\UpdateUserTypeStrategy;

class DatabaseCommandFactoryTest extends TestCase
{
    private $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new DatabaseCommandFactory();
    }

    public function testInstanceOfCreateSubmissionStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::CREATE_SUBMISSION_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof CreateSubmissionStrategy);
    }

    public function testInstanceOfCreateUserTypeStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::CREATE_USER_TYPE_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof CreateUserTypeStrategy);
    }

    public function testInstanceOfDeleteHardUserTypeStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::DELETE_HARD_USER_TYPE_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof DeleteHardUserTypeStrategy);
    }

    public function testInstanceOfDeleteSoftUserTypeStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::DELETE_SOFT_USER_TYPE_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof DeleteSoftUserTypeStrategy);
    }

    public function testInstanceOfDeleteSubmissionStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::DELETE_SUBMISSION_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof DeleteSubmissionStrategy);
    }

    public function testInstanceOfGetSubmissionStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::GET_SUBMISSION_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof GetSubmissionStrategy);
    }

    public function testUserTypeWithoutTrashedStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::GET_USER_TYPE_WITHOUT_TRASHED_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof GetUserTypeWithoutTrashedStrategy);
    }

    public function testUserTypeWithTrashedStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::GET_USER_TYPE_WITH_TRASHED_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof GetUserTypeWithTrashedStrategy);
    }

    public function testRestoreUserTypeStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::RESTORE_USER_TYPE_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof RestoreUserTypeStrategy);
    }

    public function testUpdateSubmissionStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::UPDATE_SUBMISSION_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof UpdateSubmissionStrategy);
    }

    public function testUpdateUserTypeStrategy() : void
    {
        // given
        $constant = DatabaseOperationConstants::UPDATE_USER_TYPE_STRATEGY;
        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;
        // then
        $this->assertTrue($instance instanceof UpdateUserTypeStrategy);
    }
    
}