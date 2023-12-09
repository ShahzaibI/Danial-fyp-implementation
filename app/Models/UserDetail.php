<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    // use HasFactory;
    protected $fillable = ['user_id','firstname', 'surname', 'email', 'phone', 'address', 'city', 'picture','resume', 'summary', 'company_category_id', 'job_level', 'education', 'employment_type'];
}
