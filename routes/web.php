<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/user-type/without-trashed/{id}','GetUserTypeWithoutTrashedController@findByIdWithoutTrashed');
$router->get('/user-type/with-trashed/{id}','GetUserTypeWithTrashedController@findByIdWithTrashed');
$router->get('/submission/{id}', 'GetSubmissionByIdController@getSubmissionById');

$router->post('/user-type', 'CreateUsertypeController@create');
$router->post('/submission', 'CreateSubmissionController@create');

$router->put('/user-type', 'UpdateUserTypeController@update');
$router->put('/user-type/restore', 'RestoreUserTypeController@restoreUserType');
$router->put('/submission', 'UpdateSubmissionController@updateSubmission');


$router->delete('/delete/soft/user-type', 'DeleteSoftUserTypeController@deleteSoftUserTypeById');
$router->delete('/delete/hard/user-type', 'DeleteHardUserTypeController@deleteHardUserTypeById');
$router->delete('/delete/submission', 'DeleteSubmissionController@deleteSubmissionById');
