<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
	
    protected $table = 'submissions';
    protected $fillable = ['name', 'id', 'surname', 'phone', 'email', 'developer_type', 'developer_skill', 'linked_in_profile', 'github_profile', 'description', 'files', 'submission_type'];
       
}