<?php

use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\RestoreUserTypeStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class RestoreUserTypeStrategyTest extends TestCase
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

        $userType = new UserType();
        $userType->name = "Soft deleted user";
        $userType->save();
        $userType->delete();

        $this->strategy = new RestoreUserTypeStrategy();

    }

    public function testRestoreUserType() : void
    {
        // given
        $id  = ['id' => 2];
        

        $data = [
            'method' => 'put', 'uri' => '/user-type/restore', 'parameters' => $id 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('Soft deleted user', $result_data['content']['user_type']['name']);
        $this->assertEquals(2, $result_data['content']['user_type']['id']);
       
    }

   
    public function testRestoreUserThatIsNotSoftDeleted() : void
    {
        // given
        $id = ['id' => 1];

        $data = [
            'method' => 'post', 'uri' => '/delete/soft/user-type', 'parameters' => $id 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The user is not soft deleted', $result_data['error_messages']['error']);
    }

    public function testRestoreUserThatDoesNotExist() : void
    {
        // given
        $id = ['id' => 9867];

        $data = [
            'method' => 'post', 'uri' => '/delete/soft/user-type', 'parameters' => $id 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['id'][0]);
    }

    public function testRestoreUserWithIdThatIsNotInteger() : void
    {
        // given
        $id = ['id' => 'I am not integer'];

        $data = [
            'method' => 'post', 'uri' => '/delete/soft/user-type', 'parameters' => $id 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id must be an integer.', $result_data['error_messages']['id'][0]);
    }

    
}