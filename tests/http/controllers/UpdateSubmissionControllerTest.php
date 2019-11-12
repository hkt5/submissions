<?php

use App\UserType;
use App\Submission;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class UpdateSubmissionControllerTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    private $data =  [
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
    
    protected $response = [
            'name' => 'Czesiu',
            'surname' => 'Kowalski',
            'phone' => '0700880788',
            'email' => 'awesomeemail@gmail.com',
            'developer_type' => 8,
            'developer_skill' => 7,
            'linked_in_profile' => 'http://www.linkedin.com/czesiu',
            'github_profile' => 'http://www.github.com/czesiukowalski',
            'description' => 'awesome developer',
            'submission_type' => 1
        ];
        

    public function setUp(): void
    {
        parent::setUp();
      
        $userType = new UserType();
        $userType->name = "Some user type";
        $userType->save();

        Submission::create($this->data);
    }

    public function testUpdateSubmission() : void
    {
        
        $data = [
            'id' => 1,
            'email' => 'validEmail@gmail.com'
        ];

        $response = $this->response;
        $response['email'] = 'validEmail@gmail.com';
        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
        
    }

    public function testUpdateSubmissionWithInvalidEmail() : void
    {
        
        $data = [
            'id' => 1,
            'email' => 'definitelly wrong email'
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'email' => ['The email format is invalid.']
            ],
        ];

        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
        
    }

    public function testUpdateSubmissionWithInvalidId() : void
    {
        
        $data = [
            'description' => 'junior developer',
            'id' => 9877
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The selected id is invalid.']
            ],
        ];

        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
        
    }

    public function testUpdateSubmissionWithMissingId() : void
    {
        
        $data = [
            'email' => 'awesome@email.com'
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The id field is required.']
            ],
        ];

        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
        
    }



    public function testUpdateSubmissionWithInvalidPhoneNumber() : void
    {
        
        $data = [
            'id' => 1,
            'phone' => 'incorrect phone number'
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'phone' => ['The phone format is invalid.']
            ],
        ];

        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
        
    } 

    public function testUpdateSubmissionWithEmailThatAlreadyExists() : void
    {
        
        $data = [
            'id' => 1,
            'email' => 'czesiu@gmail.com'
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'email' => ['The email has already been taken.']
            ],
        ];

        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
        
    } 

    public function testUpdateSubmissionWithUserTypeThatDoesNotExists() : void
    {
        
        $data = [
            'id' => 1,
            'submission_type' => 57657
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'submission_type' => ['The selected submission type is invalid.']
            ],
        ];

        $result = $this->put('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJsonContains($response);
        
    }     

}