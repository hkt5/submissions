<?php

use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\CreateUserTypeStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateUserTypeStrategyTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    private $strategy;

    public function setUp(): void
    {
        parent::setUp();
       
        $userType = new UserType();
        $userType->name = "Some user type";
        $userType->save();
        $this->strategy = new CreateUserTypeStrategy();

    }

    public function testCreateUserType() : void
    {
        // given
        $userTypeData = ['name' => 'something'];
        

        $data = [
            'method' => 'post', 'uri' => '/user-type', 'parameters' => $userTypeData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('something', $result_data['content']['user_type']['name']);
        $this->assertEquals(2, $result_data['content']['user_type']['id']);
       
    }

   
    public function testCreateUserTypeWhenNameExists() : void
    {
        // given
        $userTypeData = ['name' => 'Some user type'];

        $data = [
            'method' => 'post', 'uri' => '/user-type', 'parameters' => $userTypeData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The name has already been taken.', $result_data['error_messages']['name'][0]);
    }

    public function testCreateUserTypeWhenNameIsToShort() : void
    {
        // given
        $userTypeData = ['name' => 'S'];

        $data = [
            'method' => 'post', 'uri' => '/user-type', 'parameters' => $userTypeData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The name must be at least 3 characters.', $result_data['error_messages']['name'][0]);
    }

     public function testCreateUserTypeWhenNameIsToLong() : void
    {
        // given
        $userTypeData = ['name' => 'awertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrtyawertyuoploiuytrty'];

        $data = [
            'method' => 'post', 'uri' => '/user-type', 'parameters' => $userTypeData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The name may not be greater than 167 characters.', $result_data['error_messages']['name'][0]);
    }



    

}