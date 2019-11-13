<?php

use App\UserType;
use App\Submission;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\GetSubmissionStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class GetSubmissionStrategyTest extends TestCase
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

        $submission = new Submission();
        $submission->__set('name', 'Czesiu');
        $submission->__set('surname', 'Kowalski');
        $submission->__set('phone', '0700880788');
        $submission->__set('email', 'czesiu@gmail.com');
        $submission->__set('developer_type', 8);
        $submission->__set('developer_skill', 7);
        $submission->__set('linked_in_profile', 'http://www.linkedin.com/czesiu');
        $submission->__set('github_profile', 'http://www.github.com/czesiukowalski');
        $submission->__set('description', 'awesome developer');
        $submission->__set('files', '{"file":"somefile.txt"}');
        $submission->__set('submission_type', 1);
        $submission->save();

        $this->strategy = new GetSubmissionStrategy();

    }

    public function testGetExistingSubmission() : void
    {
        // given
        $id = 1;

        $data = [
            'method' => 'get', 'uri' => '/submission/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($id);
        $result_data = json_decode($result->content(), true);
        // then
       
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals('Czesiu', $result_data['content']['submission']['name']);
        $this->assertEquals('Kowalski', $result_data['content']['submission']['surname']);
        $this->assertEquals('0700880788', $result_data['content']['submission']['phone']);
        $this->assertEquals('czesiu@gmail.com', $result_data['content']['submission']['email']);
        $this->assertEquals(8, $result_data['content']['submission']['developer_type']);
        $this->assertEquals(7, $result_data['content']['submission']['developer_skill']);
        $this->assertEquals('http://www.linkedin.com/czesiu', $result_data['content']['submission']['linked_in_profile']);
        $this->assertEquals('http://www.github.com/czesiukowalski', $result_data['content']['submission']['github_profile']);
        $this->assertEquals('awesome developer', $result_data['content']['submission']['description']);
        $this->assertEquals(1, $result_data['content']['submission']['submission_type']);

    }
   
    public function testGetSubmissionWhichDoesNotExist() : void
    {
        // given
        $id = 25421;

        $data = [
            'method' => 'get', 'uri' => '/submission/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($id);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['id'][0]);
    }


    public function testGetSubmissionWhichIsNotInteger() : void
    {
        // given
        $id = "I am not integer";

        $data = [
            'method' => 'get', 'uri' => '/submission/'.$id, 'parameters' => [] 
            
            , 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];

        $request = MockingRequest::createRequest($data);
        // when
        $result = $this->strategy->command($id);
        $result_data = json_decode($result->content(), true);
        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id must be an integer.', $result_data['error_messages']['id'][0]);
    }
    
}



