<?php

use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\GetUserTypeWithoutTrashedStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class GetUserTypeWithoutTrashedStrategyTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    private $strategy;

    public function setUp(): void
    {
        parent::setUp();

        $userType = new UserType();
        $userType->__set('name', 'I am not soft deleted');
        $userType->save();

        $userType = new UserType();
        $userType->__set('name', 'I am soft deleted');
        $userType->save();
        $userType->delete();

        $this->strategy = new GetUserTypeWithoutTrashedStrategy();

    }

    public function testGetUntrashedUser() : void
    {
        // given
        
        $id = 1;

        $data = [
            'method' => 'get', 'uri' => '/user-type/without-trashed/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('I am not soft deleted', $result_data['content']['user_type']['name']);
        $this->assertEquals(1, $result_data['content']['user_type']['id']);
       
    }

   
    public function testGetTrashedUserType() : void
    {
        // given
        $id = 2;

        $data = [
            'method' => 'get', 'uri' => '/user-type/without-trashed/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['error']);
    }

    public function testGetUserWhichDoesNotExist() : void
    {
        // given
        $id = 26544;

        $data = [
            'method' => 'get', 'uri' => '/user-type/without-trashed/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['id'][0]);
    }

    public function testGetUserWhithIdThatIsNotInteger() : void
    {
        // given
        $id = "I am not integer";

        $data = [
            'method' => 'get', 'uri' => '/user-type/without-trashed/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id must be an integer.', $result_data['error_messages']['id'][0]);
    }

}