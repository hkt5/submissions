<?php

use App\Submission;
use App\UserType;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\CreateSubmissionStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateSubmissionStrategyTest extends TestCase
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
        $this->strategy = new CreateSubmissionStrategy();
    }

    public function testCreateSubmission() : void
    {
        // given
        $submissionData = $this->submissionData;
        $submissionData['email'] = 'another@email.com';

        $data = [
            'method' => 'post', 'uri' => '/submission', 'parameters' => $submissionData 
            
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
        $this->assertEquals('another@email.com', $result_data['content']['submission']['email']);
        $this->assertEquals(8, $result_data['content']['submission']['developer_type']);
        $this->assertEquals(7, $result_data['content']['submission']['developer_skill']);
        $this->assertEquals('http://www.linkedin.com/czesiu', $result_data['content']['submission']['linked_in_profile']);
        $this->assertEquals('http://www.github.com/czesiukowalski', $result_data['content']['submission']['github_profile']);
        $this->assertEquals('awesome developer', $result_data['content']['submission']['description']);
        $this->assertEquals(1, $result_data['content']['submission']['submission_type']);

       
    }

    
    public function testCreateSubmissionWithInvalidEmail() : void
    {
        // given
        $submissionData = $this->submissionData;
        $submissionData['email'] = 'wrong email';

        $data = [
            'method' => 'post', 'uri' => '/submission', 'parameters' => $submissionData 
            
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

    public function testCreateSubmissionWithInvalidPhone() : void
    {
        // given
        $submissionData = $this->submissionData;
        $submissionData['phone'] = 'invalid phone';

        $data = [
            'method' => 'post', 'uri' => '/submission', 'parameters' => $submissionData 
            
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

    public function testCreateSubmissionWithNotUniqueEmail() : void
    {
        // given
        $submissionData = $this->submissionData;

        $data = [
            'method' => 'post', 'uri' => '/submission', 'parameters' => $submissionData 
            
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

    public function testCreateSubmissionWithNonExistingUserType() : void
    {
        // given
        $submissionData = $this->submissionData;
        $submissionData['submission_type'] = 987;

        $data = [
            'method' => 'post', 'uri' => '/submission', 'parameters' => $submissionData 
            
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