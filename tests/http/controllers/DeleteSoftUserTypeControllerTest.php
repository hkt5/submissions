<?php

use App\UserType;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class DeleteSoftUserTypeControllerTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $userType = new UserType();
        $userType->__set('name', 'first_name');
        $userType->save();

        $userType = new UserType();
        $userType->__set('name', 'second_name');
        $userType->save();
    }

    public function testDeleteSoftUserType() : void
    {
        // given
        $data = ['id' => 1];
        // when
        $result = $this->delete('/delete/soft/user-type',$data);
        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains(['name' => 'first_name', 'id' => 1]);
    }

    public function testDeleteSoftUserTypeThatIsAlreadySoftDeleted() : void
    {
        // given
        $data = ['id' => 2];
        $response = ['content' => [], 'error_messages' => ['error' => 'The user was already soft deleted']];
        // when
        $result = $this->delete('/delete/soft/user-type',$data);
        $result = $this->delete('/delete/soft/user-type',$data);
        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteSoftUserTypeThatDoesNotExist() : void
    {
        $data = ['id' => 1987];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The selected id is invalid.']
            ],
        ];
    
        $result = $this->delete('/delete/soft/user-type',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteSoftUserTypeWithIdThatIsNotInteger() : void
    {
        $data = ['id' => 'I am not an integer'];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The id must be an integer.']
            ],
        ];
    
        $result = $this->delete('/delete/soft/user-type',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    
}
