<?php

use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\UpdateUserTypeStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateUserTypeStrategyTest extends TestCase
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
        $this->strategy = new UpdateUserTypeStrategy();

    }

    public function testUpdateUserType() : void
    {
        // given
        $data = [
            'id' => 1,
            'name' => 'super_unique_name'
        ];
        

        $data = [
            'method' => 'put', 'uri' => '/user-type', 'parameters' => $data 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('super_unique_name', $result_data['content']['user_type']['name']);
        $this->assertEquals(1, $result_data['content']['user_type']['id']);
       
    }

   
    public function testUpdateUserTypeWithExistingName() : void
    {
        // given
        $data = ['name' => 'Some user type', 'id' => 1];

        $data = [
            'method' => 'put', 'uri' => '/user-type', 'parameters' => $data 
            
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

    public function testUpdateUserTypeWithoutId() : void
    {
        // given
        $data = ['name' => 'Some user type'];

        $data = [
            'method' => 'put', 'uri' => '/user-type', 'parameters' => $data 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id field is required.', $result_data['error_messages']['id'][0]);
    }

    public function testUpdateUserTypeWithIdThatIsNotInteger() : void
    {
        // given
        $data = [
            'name' => 'jurek',
            'id' => 'I am not integer'
        ];

        $data = [
            'method' => 'put', 'uri' => '/user-type', 'parameters' => $data 
            
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