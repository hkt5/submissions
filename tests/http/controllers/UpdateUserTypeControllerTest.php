<?php

use App\UserType;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class UpdateUserTypeControllerTest extends TestCase
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
    }

    public function testUpdateUserType() : void
    {
        // given
        
        $dataBoth = [
            'id' => 1,
            'name' => 'super_unique_name'
        ];
        // when
        $result = $this->put('/user-type',$dataBoth);
        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($dataBoth);
    }

    public function testUpdateUserTypeWithExistingName() : void
    {
        // given
        
        $data = [
            'id' => 1,
            'name' => 'czesiu'
        ];

         $response = [
            'content' => [], 'error_messages' => [
                'name' => ['The name has already been taken.']
            ],
        ];
        // when
        $result = $this->put('/user-type',$data);
        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
    }

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

}
