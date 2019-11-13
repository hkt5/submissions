<?php

use App\Submission;
use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\UpdateSubmissionStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateSubmissionStrategyTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    private $strategy;
    private $submissionData  =  [
            'name' => 'Czesiu',
            'surname' => 'Kowalski',
            'phone' => '0700880788',
            'email' => 'czesiu@gmail.com',
            'developer_type' => 8,
            'developer_skill' => 7,
            'linked_in_profile' => 'http://www.linkedin.com/czesiu',
            'github_profile' => 'http://www.github.com/czesiukowalski',
            'files' => '{"file":"somefile.txt"}',
            'description' => 'awesome developer',
            'submission_type' => 1
        ];

    public function setUp(): void
    {
        parent::setUp();
       
        $userType = new UserType();
        $userType->name = "Some user type";
        $userType->save();

        Submission::create($this->submissionData);
        $this->strategy = new UpdateSubmissionStrategy();
    }

    public function testUpdateSubmission() : void
    {
        // given
        $updateData = [
            'id' => 1,
            'email' => 'validEmail@gmail.com'
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('Czesiu', $result_data['content']['submission']['name']);
        $this->assertEquals('Kowalski', $result_data['content']['submission']['surname']);
        $this->assertEquals('0700880788', $result_data['content']['submission']['phone']);
        $this->assertEquals('validEmail@gmail.com', $result_data['content']['submission']['email']);
        $this->assertEquals(8, $result_data['content']['submission']['developer_type']);
        $this->assertEquals(7, $result_data['content']['submission']['developer_skill']);
        $this->assertEquals('http://www.linkedin.com/czesiu', $result_data['content']['submission']['linked_in_profile']);
        $this->assertEquals('http://www.github.com/czesiukowalski', $result_data['content']['submission']['github_profile']);
        $this->assertEquals('awesome developer', $result_data['content']['submission']['description']);
        $this->assertEquals(1, $result_data['content']['submission']['submission_type']);
        $this->assertEquals(1, $result_data['content']['submission']['id']);

       
    }

    
    public function testUpdateSubmissionWithInvalidEmail() : void
    {
        // given
         $updateData = [
            'id' => 1,
            'email' => 'definitelly wrong email'
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The email format is invalid.', $result_data['error_messages']['email'][0]);
    }

    public function testUpdateSubmissionWithInvalidId() : void
    {
        // given
         $updateData = [
            'id' => 1877,
            'email' => 'definitelly wrong email'
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
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

    public function testUpdateSubmissionWhenIdIsMissing() : void
    {
        // given
         $updateData = [
            'email' => 'updated@gmail.com'
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
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

     public function testUpdateSubmissionWithInvalidPhoneNumber() : void
    {
        // given
         $updateData = [
            'id' => 1,
            'phone' => 'xcvtyuiol'
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The phone format is invalid.', $result_data['error_messages']['phone'][0]);
    }

     public function testUpdateSubmissionWithEmailThatAlreadyExists() : void
    {
        // given
         $updateData = [
            'id' => 1,
            'email' => 'czesiu@gmail.com'
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The email has already been taken.', $result_data['error_messages']['email'][0]);
    }

    public function testUpdateSubmissionWithUserTypeThatDoesNotExists() : void
    {
        // given
          $updateData = [
            'id' => 1,
            'submission_type' => 57657
        ];

        $data = [
            'method' => 'put', 'uri' => '/submission', 'parameters' => $updateData 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected submission type is invalid.', $result_data['error_messages']['submission_type'][0]);
    }
  
}