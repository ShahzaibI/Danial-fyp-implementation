<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    // use HasFactory;
    protected $fillable = ['user_id', 'job_title', 'company_name', 'city', 'country', 'description'];
}