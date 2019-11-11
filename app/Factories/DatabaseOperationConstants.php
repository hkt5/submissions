<?php

namespace App\Factories;


class DatabaseOperationConstants
{
    public const GET_USER_TYPE_WITHOUT_TRASHED_STRATEGY = 'get user type without trashed strategy';
    public const GET_USER_TYPE_WITH_TRASHED_STRATEGY = 'get user type with trashed strategy';
    public const CREATE_USER_TYPE_STRATEGY = 'create user type strategy';
    public const UPDATE_USER_TYPE_STRATEGY = 'update user type strategy';
    public const DELETE_SOFT_USER_TYPE_STRATEGY = 'delete soft user type strategy';
    public const DELETE_HARD_USER_TYPE_STRATEGY = 'delete hard user type strategy';
    public const RESTORE_USER_TYPE_STRATEGY = 'restore user type strategy';

    public const CREATE_SUBMISSION_STRATEGY = 'create submission strategy';
    public const GET_SUBMISSION_STRATEGY = 'get submission strategy';
    public const UPDATE_SUBMISSION_STRATEGY = 'update submission strategy';
    public const DELETE_SUBMISSION_STRATEGY = 'delete submission strategy';
}