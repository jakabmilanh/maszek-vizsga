<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'review_id';

    protected $fillable = ['job_id', 'reviewer_id', 'reviewee_id', 'rating', 'review_text'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }


    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id');
    }
}
