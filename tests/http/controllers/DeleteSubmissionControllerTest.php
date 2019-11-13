<?php

use App\UserType;
use App\Submission;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;


class DeleteSubmissionControllerTest extends TestCase
{
    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

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

    }

    public function testDeleteSubmission() : void
    {
        // given
        $data = ['id' => 1];
        $response = [
            'name' => 'Czesiu',
            'surname' => 'Kowalski',
            'phone' => '0700880788',
            'email' => 'czesiu@gmail.com',
            'developer_type' => 8,
            'developer_skill' => 7,
            'linked_in_profile' => 'http://www.linkedin.com/czesiu',
            'github_profile' => 'http://www.github.com/czesiukowalski',
            'description' => 'awesome developer',
            'submission_type' => 1
        ];
        // when
        $result = $this->delete('/delete/submission',$data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains($response);
    }


    public function testDeleteSubmissionThatDoesNotExist() : void
    {
        $data = ['id' => 1987];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The selected id is invalid.']
            ],
        ];
    
        $result = $this->delete('/delete/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteSubmissionWithIdThatIsNotInteger() : void
    {
        $data = ['id' => "I am not integer"];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['The id must be an integer.']
            ],
        ];
    
        $result = $this->delete('/delete/submission',$data);
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    
}
