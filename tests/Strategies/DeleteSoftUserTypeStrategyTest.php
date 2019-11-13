<?php

use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\DeleteSoftUserTypeStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteSoftUserTypeStrategyTest extends TestCase
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

        $this->strategy = new DeleteSoftUserTypeStrategy();

    }

    public function testDeleteSoftUserType() : void
    {
        // given
        $userTypeData = ['id' => 1];
        

        $data = [
            'method' => 'delete', 'uri' => '/delete/soft/user-type', 'parameters' => $userTypeData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('Some user type', $result_data['content']['user_type']['name']);
        $this->assertEquals(1, $result_data['content']['user_type']['id']);
       
    }

   
    public function testDeleteSoftUserTypeThatIsAlreadySoftDeleted() : void
    {
        // given
        $userTypeData = ['id' => 2];

        $data = [
            'method' => 'post', 'uri' => '/delete/soft/user-type', 'parameters' => $userTypeData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The user was already soft deleted', $result_data['error_messages']['error']);
    }

    public function testDeleteSoftUserTypeThatDoesNotExist() : void
    {
        // given
        $userTypeData = ['id' => 27655];

        $data = [
            'method' => 'post', 'uri' => '/delete/soft/user-type', 'parameters' => $userTypeData 
            
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

    public function testDeleteSoftUserTypeWithIDThatIsNotInteger() : void
    {
        // given
        $userTypeData = ['id' => 'I am not an integer'];

        $data = [
            'method' => 'post', 'uri' => '/delete/soft/user-type', 'parameters' => $userTypeData 
            
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