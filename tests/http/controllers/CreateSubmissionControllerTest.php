<?php

use App\UserType;
use App\Submission;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class CreateSubmissionControllerTest extends TestCase
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
        // given
        

    public function setUp(): void
    {
        parent::setUp();
      
        $userType = new UserType();
        $userType->name = "Some user type";
        $userType->save();

        Submission::create($this->data);
    }

    public function testCreateSubmission() : void
    {
        $response = [
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
        // when
        $data = $this->data;
        $data['email'] = "awesomeemail@gmail.com";
        $result = $this->post('/submission',$data);
        // then
        
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
        
    } 


    public function testCreateSubmissionWithInvalidEmail() : void
    {
        
        $data = $this->data;
        $data['email'] = 'sssqwer';


        $response = [
            'content' => [], 'error_messages' => [
                'email' => ['The email format is invalid.']
            ],
        ];
    
        $result = $this->post('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateSubmissionWithInvalidPhone() : void
    {
        
        $data = $this->data;
        $data['phone'] = 'invalid phone number';
        $data['email'] = "myemail@gmail.com";


        $response = [
            'content' => [], 'error_messages' => [
                'phone' => ['The phone format is invalid.']
            ],
        ];
    
        $result = $this->post('/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

   public function testCreateSubmissionWithNotUniqueEmail() : void
    {
        
        $response = [
            'content' => [], 'error_messages' => [
                'email' => ['The email has already been taken.']
            ],
        ];

        $result = $this->post('/submission',$this->data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    } 

    public function testCreateSubmissionWithNonExistingUserType() : void
    {
        
        $response = [
            'content' => [], 'error_messages' => [
                'submission_type' => ['The selected submission type is invalid.']
            ],
        ];
        
        $invalidData = $this->data;
        $invalidData['submission_type'] = 987;
        $invalidData['email'] = "somenice@email.com";

        $result = $this->post('/submission',$invalidData);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }   
   
}