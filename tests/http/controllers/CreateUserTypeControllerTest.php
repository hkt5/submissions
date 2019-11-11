<?php

use App\UserType;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class CreateUserTypeControllerTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $userType = new UserType();
        $userType->__set('name', 'not_unique_name');
        $userType->save();
    }

    public function testCreateUserType() : void
    {
        // given
        $data = ['name' => 'super_unique_name'];
        // when
        $result = $this->post('/user-type',$data);
        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains(['name' => 'super_unique_name']);
    }

    public function testCreateUserTypeWhenNameExists() : void
    {
        $data = ['name' => 'not_unique_name'];

        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['The name has already been taken.']
            ],
        ];
    
        $result = $this->post('/user-type',$data); 
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateUserTypeWhenNameIsToShort() : void
    {
        $data = ['name' => 'a'];

        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['The name must be at least 3 characters.']
            ],
        ];
    
        $result = $this->post('/user-type',$data); 
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateUserTypeWhenNameIsToLong() : void
    {
        $data = ['name' => 'awertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrty'];

        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['The name may not be greater than 167 characters.']
            ],
        ];
    
        $result = $this->post('/user-type',$data); 
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
