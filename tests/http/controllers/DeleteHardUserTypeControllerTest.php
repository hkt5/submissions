<?php

use App\UserType;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class DeleteHardUserTypeControllerTest extends TestCase
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
    }

    public function testDeleteHardUserType() : void
    {
        // given
        $data = ['id' => 1];
        // when
        $result = $this->delete('/delete/hard/user-type',$data);
        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains(['name' => 'first_name', 'id' => 1]);
    }


    public function testDeleteHardUserTypeThatDoesNotExist() : void
    {
        $data = ['id' => 1987];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The selected id is invalid.']
            ],
        ];
    
        $result = $this->delete('/delete/hard/user-type',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteHardUserTypeWithIDThatIsNotInteger() : void
    {
        $data = ['id' => 'asdf'];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The id must be an integer.']
            ],
        ];
    
        $result = $this->delete('/delete/hard/user-type',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    
}
