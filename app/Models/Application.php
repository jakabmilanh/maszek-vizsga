<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'application_id';

    protected $fillable = ['job_id', 'employee_id', 'status', 'cover_letter'];

    public function job()
        {
            return $this->belongsTo(Job::class, 'job_id');
        }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
