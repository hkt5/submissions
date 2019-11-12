<?php

use App\UserType;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class RestoreUserTypeControllerTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $userType = new UserType();
        $userType->__set('name', 'czesiu');
        $userType->save();
        $userType->delete();

        $userType = new UserType();
        $userType->__set('name', 'jurek');
        $userType->save();
    }

    public function testRestoreUserType() : void
    {
        // given
        
        $data = [
            'id' => 1
        ];

        $response = [
           'id' => 1,
           'name' => 'czesiu'
        ];
        // when
        $result = $this->put('/user-type/restore',$data);
        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
    }

    public function testRestoreUserThatIsNotSoftDeleted() : void
    {
        // given
        $data = [
            'id' => 2,
        ];

         $response = ['content' => [], 'error_messages' => ['error' => 'The user is not soft deleted']];
        // when
        $result = $this->put('/user-type/restore',$data);
        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
    }

    public function testRestoreUserThatDoesNotExist() : void
    {
        // given
        $data = [
            'id' => 25432,
        ];

         $response = ['content' => [], 'error_messages' => ['id' => ['The selected id is invalid.']]];
        // when
        $result = $this->put('/user-type/restore',$data);
        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
    }
/*
    public function testUpdateUserTypeWithoutId() : void
    {
        // given
        
        $data = [
            'name' => 'jurek'
        ];

         $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The id field is required.']
            ],
        ];
        // when
        $result = $this->put('/user-type',$data);
        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
    }
  */
}
