<?php

use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\DeleteHardUserTypeStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteHardUserTypeStrategyTest extends TestCase
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
        $this->strategy = new DeleteHardUserTypeStrategy();

    }

    public function testDeleteHardUserType() : void
    {
        // given
        $userTypeData = ['id' => 1];
        

        $data = [
            'method' => 'delete', 'uri' => '/delete/hard/user-type', 'parameters' => $userTypeData 
            
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

   
    public function testDeleteHardUserTypeThatDoesNotExist() : void
    {
        // given
        $userTypeData = ['id' => 1987];

        $data = [
            'method' => 'post', 'uri' => '/delete/hard/user-type', 'parameters' => $userTypeData 
            
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

    public function testDeleteHardUserTypeWithIDThatIsNotInteger() : void
    {
        // given
        $userTypeData = ['id' => 'I am not an integer'];

        $data = [
            'method' => 'post', 'uri' => '/delete/hard/user-type', 'parameters' => $userTypeData 
            
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